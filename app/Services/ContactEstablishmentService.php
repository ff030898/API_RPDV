<?php

namespace App\Services;

use App\Repositories\ContactsEstablishmentRepository;
use Illuminate\Http\Request;

class ContactEstablishmentService
{
    protected $repository;

    public function __construct(ContactsEstablishmentRepository $contactRepository)
    {
        $this->repository = $contactRepository;
    }

    public function getContacts(string $identify)
    {
        return $this->repository->getAll($identify);
    }

    public function createNewContact(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getContact(string $identify)
    {
        return $this->repository->getContact($identify);
    }

    public function updateContact(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteContact(string $identify)
    {
        return $this->repository->delete($identify);
    }
}