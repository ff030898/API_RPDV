<?php

namespace App\Repositories;

use App\Models\ContactsEstablishments;
use Illuminate\Http\Request;

class ContactsEstablishmentRepository
{
    protected $entity;

    public function __construct(ContactsEstablishments $contact)
    {
        $this->entity = $contact;
    }

    public function getAll(string $identify)
    {
        return $this->entity::where('fk_establishments', $identify)->get();
    }

    public function getContact(string $identify)
    {
        $contact = $this->entity::where('id', $identify)->first();
        return $contact;
    }

    public function createNew(Request $data)
    {
        $contact = $data->all();
        $this->entity::create($contact);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $contact = $this->getContact($identify);
        
        $contact->phone = $data->input('phone');

        $contact->save();
    
        return $contact;
        
    }

    public function delete(string $identify)
    {
        $contact = $this->getContact($identify);
       
        return $contact->delete();
        
    }
}