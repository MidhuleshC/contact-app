<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use SimpleXMLElement;

class ContactController extends Controller
{
    // List contacts
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    // Create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required|unique:contacts,phone',
        ]);
        Contact::create($request->only(['name', 'lastName', 'phone']));    
        return redirect()->route('contacts.index');
    }

    // Edit contact
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required|unique:contacts,phone,' . $contact->id,
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index');
    }

    // Delete contact
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index');
    }

    public function showImportForm()
    {
        return view('contacts.import');
    }
    
    // Import contacts from XML
    public function importXML(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml',
        ]);

        $xmlData = file_get_contents($request->file('xml_file'));
        $xml = new SimpleXMLElement($xmlData);

        foreach ($xml->contact as $contact) {
            Contact::updateOrCreate(
                ['phone' => (string) $contact->phone],
                [
                    'name' => (string) $contact->name,
                    'lastName' => (string) $contact->lastName,
                ]
            );
        }

        return redirect()->route('contacts.index');
    }
}
