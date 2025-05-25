<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function index()
    {
        $group = Group::orderBy('id', 'DESC')->get();
        return view('backend.groups', compact('group'));
    }

    public function create()
    {
        return view('backend.group-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:groups,slug',
            /*'description' => 'required',*/
            /*'income_commission' => 'required',
            'expense_commission' => 'required',*/
        ]);

        $group = new Group();
        $group->title           = $request->title;
        $group->description     = $request->description;
        $group->color           = $request->color;
        $group->slug            = Str::slug($request->title);
        $group->save();

        $notification = array(
            'message' => '👋 Grup Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.groups.index')->with($notification);
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group)
    {
        return view('backend.group-edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $group->title           = $request->title;
        $group->description     = $request->description;
        $group->color           = $request->color;
        $group->slug            = Str::slug($request->title);
        $group->save();

        $notification = array(
            'message' => '👋 Grup Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.groups.index')->with($notification);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        $notification = array(
            'message' => '👋 Grup Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.groups.index')->with($notification);
    }
}
