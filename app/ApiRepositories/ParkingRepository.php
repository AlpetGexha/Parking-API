<?php

namespace App\ApiRepositories;

use App\Interfaces\ParkingRepositoryInterface;
use App\Models\Parking;

class ParkingRepository implements ParkingRepositoryInterface
{
    private $modelName;

    public function __construct()
    {
        $this->modelName = $this->model();
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Parking::class;
    }

    /**
     * here get all data of  Parking
     **/
    public function getAllData($paginate = 10, $searchItems = null, $ordering_filed = 'id', $ordering_dir = 'desc')
    {
        if ($searchItems && ! empty($searchItems)) {
            $data = $this->filter($searchItems)->orderBy($ordering_filed, $ordering_dir)->paginate($paginate);
        } else {
            $data = $this->modelName::with([])->orderBy($ordering_filed, $ordering_dir)->paginate($paginate);
        }

        return $data;
    }

    /**
     * here get Parking by sanding id of item
     **/
    public function getItemById($itemId)
    {
        $item = $this->modelName::find($itemId);

        if (! $item) {
            return false;

        } else {
            return $item;
        }
    }

    /**
     * here delete Parking by sanding id of item
     **/
    public function deleteItem($itemId)
    {
        $item = $this->modelName::find($itemId);
        if (! $item) {
            return false;

        } else {
            $item->delete();

            return true;
        }

    }

    /**
     * here create new Parking   by sanding  new data
     **/
    public function createItem(array $newDetails)
    {

        return $this->modelName::create($newDetails);
    }

    /**
     * here update Parking by sanding id of item and new data
     **/
    public function updateItem($itemId, array $newDetails)
    {
        return $this->modelName::whereId($itemId)->update($newDetails);
    }

    public function relation()
    {
        $data = ['orders', 'orders'];

        return json_encode($data);
    }

    /**
     * here filter data by using search request data
     **/
    public function filter($searchItems)
    {
        $query = [];
        foreach ($searchItems as $key => $value) {
            $query = $this->modelName::with([])->where($key, $value);
        }

        return $query;
    }
}
