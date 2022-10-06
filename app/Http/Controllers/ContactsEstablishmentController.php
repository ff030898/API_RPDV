<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContactsEstablishment;
use App\Http\Resources\ContactsEstablishmentResource;
use App\Services\ContactEstablishmentService;
use Illuminate\Http\Request;

class ContactsEstablishmentController extends Controller
{
    
    protected $contactService;
    protected $storeUpdate;

    public function __construct(ContactEstablishmentService $contactService, StoreUpdateContactsEstablishment $storeUpdate)
    {
        $this->contactService = $contactService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($id)
    {
        $contacts = $this->contactService->getContacts($id);

        return response()->json(ContactsEstablishmentResource::collection($contacts));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateContact());
    
        $contact = $this->contactService->createNewContact($request);
        return response()->json(['Contato inserido com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $contact = $this->contactService->getContact($id);
        if($contact){
        return response()->json(new ContactsEstablishmentResource($contact));
        }else{
            return response()->json(['Contato não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateContact());

        $contact = $this->contactService->updateContact($id, $request);
        return response()->json(new ContactsEstablishmentResource($contact));
        
    }

   
    public function destroy($id)
    {
        $this->contactService->deleteContact($id);
        return response()->json(['Contato excluido com sucesso!'], 204);
    }
}