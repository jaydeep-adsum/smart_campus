<?php


namespace App\Repositories;


use App\Models\Institute;
use App\Models\User;
use Arr;
use DB;
use Exception;
use Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class InstituteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'institute','user_id','address','contact',
    ];

    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model()
    {
        return Institute::class;
    }

    /**
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            $institute = $this->create(Arr::only($input, (new Institute())->getFillable()));

            if ((isset($input['image']))) {
                $institute->addMedia($input['image'])->toMediaCollection(Institute::PATH);
            }
            // Create User
            $userInput['name'] = $input['name'];
            $userInput['email'] = $input['email'];
            $userInput['password'] = Hash::make($input['password']);
            $userInput['role'] = '1';

            $user = User::create($userInput);
            $institute->update(['user_id' => $user->id]);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $id
     * @return bool
     */
    public function updateInstitute($input, $id)
    {
        try {
            DB::beginTransaction();
            $institute = $this->update(Arr::only($input, (new Institute())->getFillable()), $id);

            if ((isset($input['image']))) {
                $institute->clearMediaCollection(Institute::PATH);
                $institute->addMedia($input['image'])->toMediaCollection(Institute::PATH);
            }
            // Create User
            $userInput['name'] = $input['name'];
            $userInput['email'] = $input['email'];
            if ($institute->user_id) {
                $user = User::find($institute->user_id);
                $user->update($userInput);
            } else {
                $userInput['password'] = Hash::make($input['password']);
                $userInput['role'] = '1';
                $user = User::create($userInput);
                $institute->update(['user_id' => $user->id]);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
