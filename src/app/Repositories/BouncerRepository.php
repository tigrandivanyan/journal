<?php


namespace App\Repositories;

use App\User;
use Bouncer;

class BouncerRepository{


    public function findUser($user_id){
        return User::findOrFail($user_id);
    }

    public function addAbilityToRole($role_name, $ability_name){
        return Bouncer::allow($role_name)->to($ability_name);
    }

    public function addAbilityWithModelToRole($role_name, $ability_name, $model_name){
//        $model_name = app($model_name);
        return Bouncer::allow($role_name)->to($ability_name, $model_name);
    }

    public function addAbilityWithModelAndModelEntityToRole($role_name, $ability_name, $model_name, $entity_id){
//        $model_name = app($model_name);
        $elementOfTheModel = $model_name::findOrFail($entity_id);
        return Bouncer::allow($role_name)->to($ability_name, $elementOfTheModel);
    }

    public function addAbilityToUser($user_id, $ability_name){
        $user = $this->findUser($user_id);
        return Bouncer::allow($user)->to($ability_name);
    }

    public function addAbilityWithModelToUser($user_id, $ability_name, $model_name){
//        $model_name = app($model_name);
        $user = $this->findUser($user_id);
        return Bouncer::allow($user)->to($ability_name, $model_name);
    }

    public function addAbilityWithModelAndModelEntityToUser($user_id, $ability_name, $model_name, $entity_id){
        $user = $this->findUser($user_id);
//        $model_name = app($model_name);
        $elementOfTheModel = $model_name::findOrFail($entity_id);
        return Bouncer::allow($user)->to($ability_name, $elementOfTheModel);
    }





    public function removeAbilityFromRole($role_name, $ability_name){
        return Bouncer::retract($role_name)->from($ability_name);
    }

    public function removeAbilityWithModelFromRole($role_name, $ability_name, $model_name){
//        $model_name = app($model_name);
        return Bouncer::retract($role_name)->from($ability_name, $model_name);
    }

    public function removeAbilityWithModelAndModelEntityFromRole($role_name, $ability_name, $model_name, $entity_id){
//        $model_name = app($model_name);
        $elementOfTheModel = $model_name::findOrFail($entity_id);
        return Bouncer::retract($role_name)->from($ability_name, $elementOfTheModel);
    }

    public function disallowAbilityFromUser($user_id, $ability_name){
        $user = $this->findUser($user_id);
        return Bouncer::disallow($user)->to($ability_name);
    }

    public function disallowAbilityWithModelFromUser($user_id, $ability_name, $model_name){
//        $model_name = app($model_name);
        $user = $this->findUser($user_id);
        return Bouncer::disallow($user)->to($ability_name, $model_name);
    }

    public function disallowAbilityWithModelAndModelEntityFromUser($user_id, $ability_name, $model_name, $entity_id){
        $user = $this->findUser($user_id);
//        $model_name = app($model_name);
        $elementOfTheModel = $model_name::findOrFail($entity_id);
        return Bouncer::disallow($user)->to($ability_name, $elementOfTheModel);
    }




    public function assignRoleToUser($role_name, $user_id){
        $user = $this->findUser($user_id);
        return Bouncer::assign($role_name)->to($user);
    }

    public function retractRoleFromUser($role_name, $user_id){
        $user = $this->findUser($user_id);
        return Bouncer::retract($role_name)->from($user);
    }



    public function allowUserToOwnModel($model_name, $user_id){
        $user = $this->findUser($user_id);
//        $model_name = app($model_name);
        return Bouncer::allow($user)->toOwn($model_name);
    }

    public function disallowUserToOwnModelWithSpecificAbility($user_id, $model_name, $ability_name){
        $user = $this->findUser($user_id);
        return Bouncer::disallow($user)->toOwn($model_name)->to($ability_name);
    }


    public function allowUserToOwnModelWithSpecificAbility($model_name, $user_id, $ability_name){
        $user = $this->findUser($user_id);

        return Bouncer::allow($user)->toOwn($model_name)->to($ability_name);  // this one works
    }

    public function allowUserToOwnAllModels($user_id){
        $user = $this->findUser($user_id);
        return Bouncer::allow($user)->toOwnEverything();
    }

    public function allowUserToOwnAllModelsWithSpecificAbility($user_id, $ability_name){
        $user = $this->findUser($user_id);
        return Bouncer::allow($user)->toOwnEverything()->to($ability_name);
    }



    public function allowEverythingToRole($role_name){
        return Bouncer::allow($role_name)->everything();
    }

    public function forbidEverythingToRole($role_name){
        return Bouncer::forbid($role_name)->everything();
    }


    public function allowEverythingToUser($user_id){
        $user = $this->findUser($user_id);
        return Bouncer::allow($user)->everything();
    }

    public function forbidEverythingToUser($user_id){
        $user = $this->findUser($user_id);
        return Bouncer::forbid($user)->everything();
    }



    public function allowRoleToManageModel($role_name, $model_name){
//        $model_name = app($model_name);
        return Bouncer::allow($role_name)->toManage($model_name);
    }

    public function forbidRoleToManageModel($role_name, $model_name){
//        $model_name = app($model_name);
        return Bouncer::forbid($role_name)->toManage($model_name);
    }



    public function unforbidAbilityFromUser($user_id, $ability_name){
        $user = $this->findUser($user_id);
        return Bouncer::unforbid($user)->to($ability_name);
    }

    public function removeAbilityWithModelFromUser($user_id, $ability_name, $model_name){
//        $model_name = app($model_name);
        $user = $this->findUser($user_id);
        return Bouncer::unforbid($user)->to($ability_name, $model_name);
    }

    public function removeAbilityWithModelAndModelEntityFromUser($user_id, $ability_name, $model_name, $entity_id){
        $user = $this->findUser($user_id);
//        $model_name = app($model_name);
        $elementOfTheModel = $model_name::findOrFail($entity_id);
        return Bouncer::unforbid($user)->to($ability_name, $elementOfTheModel);
    }


    public function checkIfUserHasRole($role_name, $user_id){
        $user = $this->findUser($user_id);
        return Bouncer::is($user)->a($role_name);
    }

    public function checkIfUserNotHasRole($role_name, $user_id){
        $user = $this->findUser($user_id);
        return Bouncer::is($user)->notA($role_name);
    }

    public function getAllRolesOfTheUser($user_id){
        $user = $this->findUser($user_id);
        return $user->getRoles();
    }

    public function getAllAbilitiesOfTheUser($user_id){
        $user = $this->findUser($user_id);
        return $user->getAbilities();
    }

    public function getAllForbiddenAbilitiesOfTheUser($user_id){
        $user = $this->findUser($user_id);
        return $user->getForbiddenAbilities();
    }

}