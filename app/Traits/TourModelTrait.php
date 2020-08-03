<?php


namespace App\Traits;


trait TourModelTrait
{
    public function createTour(array $tour)
    {
        $this->create($tour);
    }

    public function getTourById($id)
    {
        return $this->findOrFail($id);
    }
}
