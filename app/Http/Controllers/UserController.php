<?php

namespace App\Http\Controllers;

use App\Datatable\CafeteriaUserDatatable;
use App\Models\CafeteriaUser;
use App\Models\Institute;
use App\Models\User;
use App\Repositories\UserRepository;
use Auth;
use DataTables;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class UserController extends AppBaseController
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $institute = Institute::pluck('institute','id');
        if ($request->ajax()) {
            return Datatables::of((new CafeteriaUserDatatable())->get())->make(true);
        }
        return view('cafeteria_user.index',compact('institute'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return $this->sendError('The email has already been taken.');
        }
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => '2',
        ]);
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $cafe['institute_id'] = $institute_id;
        $cafe['user_id'] = $user->id;

        $cafeteriaUser = CafeteriaUser::create($cafe);

        return $this->sendResponse($cafeteriaUser, 'Cafeteria User saved successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function edit($id){
        $user = $this->userRepository->find($id);

        return $this->sendResponse($user, 'User Retrieved Successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $user = User::find($request->user_id);
        $checkUser = User::where('email', $request->email)->first();

        if ($user->id != $checkUser->id) {
            return $this->sendError('The email has already been taken.');
        }
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        $institute_id = $request->institute_id ?? Auth::user()->institute->id;
        $input['institute_id'] = $institute_id;
        $this->userRepository->update($input, $request->userId);

        return $this->sendSuccess('cafeteria user updated successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $cafeteriaUser = $this->userRepository->find($id);
        $cafeteriaUser->user()->delete();

        return $this->sendSuccess('Cafeteria user deleted successfully.');
    }
}
