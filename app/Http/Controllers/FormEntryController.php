<?php

namespace App\Http\Controllers;

use App\Models\FormEntry;
use Illuminate\Http\Request;

class FormEntryController extends Controller
{
    public function index()
    {
        return FormEntry::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'template_type' => 'nullable|string',
            'form_data' => 'required|array',
        ]);

        $entry = FormEntry::create([
            'name' => $validated['name'],
            'template_type' => $validated['template_type'],
            'data' => $validated['form_data'],
        ]);

        return response()->json($entry);
    }

    public function show($id)
    {
        return FormEntry::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $entry = FormEntry::findOrFail($id);

        $entry->update([
            'name' => $request->input('name', $entry->name),
            'template_type' => $request->input('template_type', $entry->template_type),
            'data' => array_merge($entry->data, $request->input('form_data', [])),
        ]);

        return response()->json($entry);
    }

    public function destroy($id)
    {
        FormEntry::destroy($id);
        return response()->json(['status' => 'deleted']);
    }
}
