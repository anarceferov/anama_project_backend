<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{

    use ApiResponder;

    public function index(Request $req)
    {
        if ($req->get('category')) {

            $contactForms = ContactForm::whereCategory($req->get('category'))->orderBy('created_at', 'desc')->get();
            return $this->dataResponse($contactForms);
        }

        $contactForms = ContactForm::orderBy('created_at', 'desc')->get();
        return $this->dataResponse($contactForms);
    }


    public function show($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return $this->dataResponse($contactForm);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->getValidationRules());

        $contact = new ContactForm;
        $contact->full_name = $request->full_name;
        $contact->email = $request->email;
        $contact->text = $request->text;
        $contact->category = $request->category;
        $contact->created_at = now();
        $contact->save();

        return $this->successResponse(trans('responses.ok'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getValidationRules());

        $contact = ContactForm::findOrFail($id);
        $contact->full_name = $request->full_name;
        $contact->email = $request->email;
        $contact->text = $request->text;
        $contact->category = $request->category;
        $contact->updated_at = now();
        $contact->save();

        return $this->successResponse(trans('responses.ok'));
    }


    public function destroy($id)
    {
        ContactForm::findOrFail($id)->delete();
        return $this->successResponse(trans("responses.ok"));
    }


    private function getValidationRules(): array
    {
        return [
            'full_name' => 'required',
            'text' => 'required',
            'category' => 'required',
            'email' => 'required|email',
        ];
    }
}
