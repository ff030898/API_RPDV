<?php

namespace App\Services;

use App\Repositories\SettingsRepository;
use Illuminate\Http\Request;

class SettingsService
{
    protected $repository;

    public function __construct(SettingsRepository $settingRepository)
    {
        $this->repository = $settingRepository;
    }

    public function getSettings()
    {
        return $this->repository->getAll();
    }

    public function createNewSetting(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getSetting(string $identify)
    {
        return $this->repository->getSetting($identify);
    }

    public function updateSetting(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteSetting(string $identify)
    {
        return $this->repository->delete($identify);
    }
}