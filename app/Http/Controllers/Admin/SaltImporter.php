<?php namespace App\Http\Controllers\Admin;

use DB;
use App\Salt;
use App\SaltCategory;
use App\ScheduleType;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class SaltImporter
{
    /**
     * Start the salts import process 
     * 
     * @param  Illuminate\Support\Collection $results
     * @return Redirect
     */
    public function startImport($results)
    {
        DB::transaction(function () use ($results) {
                
            foreach ($results as $input) {
                //createa salt for me  -- done 
               //then creat salt category 
               //then create st
               // link cat and st to salt 

               $salt = $this->createSalt($input);

                if (!is_null($salt)) {
                    $saltCategory = $this->createSaltCategory($input);

                    if ($saltCategory != null) {
                        $this->attachSaltCategory($salt, $saltCategory);
                    }
                       
                    $saltScheduleType = $this->createSaltScheduleType($input);
                       
                    if ($saltScheduleType != null) {
                        $this->attachSaltScheduleType($salt, $saltScheduleType);
                    }
                } else {
                    continue;
                }
            }
        });

        Flash::success('Hooray !! .Salts Imported SuccessFully .. ');
        return Redirect::to(route('salt-bulk-upload'));
    }

    /**
     * Store the salt to db 
     * 
     * @param  Object $input
     * @return 
     */
    public function storeSalt($input)
    {
        $salt = $this->createSalt($input);

        if (!is_null($salt)) {
            $saltCategory = $this->createSaltCategory($input);

            if ($saltCategory != null) {
                $this->attachSaltCategory($salt, $saltCategory);
            }
               
            $saltScheduleType = $this->createSaltScheduleType($input);
               
            if ($saltScheduleType != null) {
                $this->attachSaltScheduleType($salt, $saltScheduleType);
            }
            return true;
        }
        return false;
    }

    /**
     * Create the salt 
     * @param  Maatwebsite\Excel\Facades\Excel $input
     * @return App\Salt
     */
    protected function createSalt($input)
    {
        if($this->ifSaltNameIsNull($input->salt_name)){
            return null;
        }
     
        // if the salt with the same name exists than run the update opr`ation.
        // else create the new salt and continue ..
        $salt = $this->getSaltWithIdenticalName($input->salt_name);

        if ($salt != null) {
            //running the udpate here since we have the salt with same name .
            return $this->updateSalt($input,$salt);

        } else {
            //running the create operation here since we don't have the salt with 
            //same name .
            return $this->createNewSalt($input);
        }
    }

    /**
     * Create the new salt for the given input 
     * 
     * @param  array $input 
     * @return App\Salt
     */
    protected function createNewSalt($input)
    {
        $salt['salt_name']   = $input->salt_name;
        $salt['salt_indications']   = $input->indications;
        $salt['salt_dose']    = $input->dose;
        $salt['salt_contraindications'] = $input->contraindications;
        $salt['salt_precautions'] = $input->precautions;
        $salt['salt_adverse_effects']    = $input->adverse_effects;
        $salt['salt_storage']    = $input->storage;

        return Salt::firstOrCreate($salt);
    }

    /**
     * Udpate the existing salt as per the 
     * given input provided ..
     * 
     * @param  array    $input 
     * @param  App\Salt $salt  
     * @return App\Salt or NUll
     */
    protected function updateSalt($input,$salt)
    {        
        $salt->salt_name   = $input->salt_name;
        $salt->salt_indications   = $input->indications;
        $salt->salt_dose    = $input->dose;
        $salt->salt_contraindications = $input->contraindications;
        $salt->salt_precautions = $input->precautions;
        $salt->salt_adverse_effects    = $input->adverse_effects;
        $salt->salt_storage    = $input->storage;

        if ($salt->save()) {
            return $salt;
        }
        return null;
    }

    /**
     * Check if salt name is null .
     * 
     * @param  string $saltName
     * @return bool
     */
    protected function ifSaltNameIsNull($saltName)
    {
       if ($saltName == null) {
            //if the salt name is null in the bulk upload sheet
            //than we can procede further in that case 
            //we simply return null ..
            return true;
        }
        return false;
    }

    /**
     * It returns the salt with same name ..
     * 
     * @param  string $saltName
     * @return App\Salt or NUll
     */
    protected function getSaltWithIdenticalName($saltName)
    {
        $salt = Salt::where(['salt_name' => $saltName])->get();

        if (!$salt->isEmpty()) {
            return $salt->first();
        }
        return null;
    }

    /**
     * Create the salt category 
     * 
     * @param  Maatwebsite\Excel\Facades\Excel $input
     * @return App\SaltCategory
     */
    protected function createSaltCategory($input)
    {
        if ($input->category != null) {
            $saltCategory['name'] = $input->category;
            return SaltCategory::firstOrCreate($saltCategory);
        }
        return null;
    }

    /**
     * Attach the salt category to salt
     * 
     * @param  App\Salt $salt      
     * @param  App\SaltCategory $saltCategory 
     * @return Void
     */
    protected function attachSaltCategory($salt, $saltCategory)
    {
        $salt->saltCategories()->attach($saltCategory->id);
    }

    /**
     * Attach the salt schedule type to salt
     * 
     * @param  App\Salt $salt      
     * @param  App\ScheduleType $saltScheduleType 
     * @return Void
     */
    protected function attachSaltScheduleType($salt, $saltScheduleType)
    {
        $salt->ScheduleTypes()->attach($saltScheduleType->id);
    }

    /**
     * Create the salt schedule type
     * 
     * @param  Maatwebsite\Excel\Facades\Excel $input
     * @return App\ScheduleType
     */
    protected function createSaltScheduleType($input)
    {
        if ($input->schedule != null) {
            $data['name'] = $input->schedule;
            return ScheduleType::firstOrCreate($data);
        }
        return null;
    }
}
