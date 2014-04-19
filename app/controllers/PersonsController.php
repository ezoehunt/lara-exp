<?php

class PersonsController extends \BaseController {

	/**
	 * Display a listing of people
	 *
	 * @return Response
	 */
	public function index()
	{
		$people = Person::all();

		return View::make('people.index', compact('people'));
	}

	/**
	 * Show the form for creating a new person
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('people.create');
	}

	/**
	 * Store a newly created person in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Person::create($data);

		return Redirect::route('people.index');
	}

	/**
	 * Display the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$person = Person::findOrFail($id);

		return View::make('people.show', compact('person'));
	}

	/**
	 * Show the form for editing the specified person.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$person = Person::find($id);

		return View::make('people.edit', compact('person'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$person = Person::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Person::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$person->update($data);

		return Redirect::route('people.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Person::destroy($id);

		return Redirect::route('people.index');
	}

}