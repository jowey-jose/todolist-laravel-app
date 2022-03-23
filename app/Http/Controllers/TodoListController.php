<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{
    // Using the Model To Return all the Values in this Table, as the parameter.
    public  function index() {
        // return view('welcome', ['listItems' => ListItem::all()]);
        return view('welcome', ['listItems' => ListItem::where('is_complete', 0)-> get()]);
    }

    public function markComplete($id) {
        // \Log::info($id);

        // Fetch By Id Passed.
        $listItem = ListItem::find($id);
        $listItem->is_complete  = 1;
        $listItem->save();

        return redirect('/');
    }

    // Define the Method that takes a request Object(What we are passing from the form to our endpoint).
    public function saveItem(Request $request) {
        //  Log out all that is happening when the end point is hit,under path: (Storage/logs/laravel.log)
        //  \Log::info(json_encode($request -> all()));

        // Define Variables To save to the Db
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();

        // Pass the List of all todos, on hitting this route after creation of a new todoItem.
        // return view('welcome', ['listItems' => ListItem::all()]);

        // Redirect Back To index page on creating new todoItem.
        return redirect('/');
    }
}
