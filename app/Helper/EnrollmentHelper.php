<?php
namespace App\Helpers;
use Carbon\Carbon;

use App\Models\User;
use App\Models\FeeStructure;
use App\Models\EnrollmentPeriods;
use App\Models\StudentProfile;
use App\Models\ParentProfile;

class EnrollmentHelper
{

/**
 * get the role title based on logged in user
 * @param NA
 * @return string
 */
function getEnrollmentPeriod($startdate,$enddate){
  dd($startdate);
  $option = config('constants.ENROLLMENTPERIODS');
  $Userid = auth()->user()->id;
  $parentProfileData = User::find($id)->parentProfile()->first();
}
/**
 * get the role key based on logged in user
 * @param NA
 * @return string
 */
function getRoleKey(){

  $option = config('role.OPTION');
  $keys   = $option[Auth::user()->user_type];
  return $keys;
}

  /**
   * breadcrumb for all pages based on the rotes
   * @param NA
   * @return Array
   */
   function getBreadcrumb(){

    $dataArray  = array();
    $index      = 0;
    $routes     = Route::currentRouteName();

    try {

      if( $routes == config('constants.home') ):
        $dataArray[$index]['title'] = config('constants.homeTitle');
        $dataArray[$index]['link']  = false;
        $index++;
      else:
        if(strpos($routes, '.') !== false) :
          $explode  = explode('.', $routes);
          $dataArray = getRoutes($explode, $dataArray, $index);
        else:

        endif;

      endif;
    }
    catch(Exception $e){}
    return $dataArray;
   }

   /**
    * breadcrumb varify based on routes
    * @param $routes, $dataArray, $index
    * @return Array
    */
    function getRoutes( $routes, $dataArray, $index )
    {
      $roles  = config('role.ROLES');
      foreach ($routes as $key => $value) :

        switch( $value ) {

          case 'admin':
            $dataArray[$index+$key]['title'] = config('constants.homeTitle');
            $dataArray[$index+$key]['link']  = route( config('constants.home'));
          break;

          default:
            $value    = str_replace('_', ' ', $value);
            $dataArray[$index+$key]['title'] = isset($roles[strtoupper($value)]) ? $roles[strtoupper($value)]['TITLE'] : ucwords($value);
            $dataArray[$index+$key]['link']  = false;
          break;
        }

      endforeach;

      return $dataArray;
    }
    // Get user profile image
  function getProfileImage($userId)
  {
  	$userImage = DB::table("psi_user")->select('user_pic')->where('id', $userId)->first();
    if($userImage->user_pic) {
      $imgPath = config('constants.avatarDiskRoot').$userImage->user_pic;
  	} else {
  		$imgPath = url('images/noimagefound.png');
  	}
  	return $imgPath;

  }

  /**
   * This function is use to get the multi level impersonate.
   * @param NA
   * @return object
  */
  function getImpersonateUsers()
  {
    return Session::has('impersonate') ? Session::get('impersonate') : array();
  }

  
/**
   * This function is use to set language based on browser language
   * @param NA
   * @return object
  */
  function setLangBasedOnBrowser(){
    // get user browser language and set accordingly
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if($lang == 'fr')
      $lang = 'fn';
    $lang = $lang ? $lang : 'en'; 
    \Session::put('locale', $lang); 
    \App::setLocale(\Session::get('locale'));
  }

  /**
   * This function is use to get user language in php and set it in js
   * @param NA
   * @return object
  */
  function getUserLang(){
    // get user browser language and set accordingly
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if($lang == 'fr')
      $lang = 'fn';
    $lang = $lang ? $lang : 'en'; 
    \Session::put('locale', $lang); 
    \App::setLocale(\Session::get('locale'));
  }  
  /* check session dates are valid to accept invitaion
   * @param {Array} $sessionData
   * @return boolean
   */
  function isInvitationValid($sessionData)
  {
    if( $sessionData )
    {
      $sessionCheck     = config('constants.SESSIONCHECK');
      
      if( isset($sessionData[$sessionCheck]) )
      {
          $dates    = $sessionData[$sessionCheck];
          if( \Carbon\Carbon::parse($dates['end'])->timestamp < \Carbon\Carbon::now()->timestamp )
            return false;
          
      }
      return true;
    }
  }

  /**
  * Create a function to filter trainings data 
  * @param 
  * @return array
  */
  function deleteUser($userId, $getUser)
  {
    try { 
      DB::beginTransaction();
      $config    = config('role.ROLES');
      if($getUser->user_type){
          
          if($config['LHP']['ROLE']){
              DB::delete("delete from `psi_cohort_training_lhp` where `lhp_id` = ?",[$userId]);
              DB::delete("delete from `psi_ct_training_lhp` where `lhp_id` = ?",[$userId]);
          }

          else if($config['LT']['ROLE']){
              DB::delete("delete from `psi_cohort_training_lt` where `lt_id` = ?",[$userId]);
              DB::delete("delete from `psi_ct_training_lt` where `lt_id` = ?",[$userId]);
          }

          else if($config['CT']['ROLE']){
              DB::delete("delete from `psi_cohort_training_ct` where `ct_id` = ?",[$userId]);
              DB::delete("delete from `psi_ct_training_ct` where `ct_id` = ?",[$userId]);
          }

          else if($config['SA']['ROLE']){
              DB::delete("delete from `psi_cohort_training_sa` where `sa_id` = ?",[$userId]);
          }

          else if($config['SL']['ROLE']){
              DB::delete("delete from `psi_cohort_training_sl` where `sl_id` = ?",[$userId]);
          } 

          DB::delete("delete from `psi_profile` where `user_id` = ?",[$userId]);
          DB::delete("delete from `psi_user` where `id` = ? and `status` = ?",[$userId, false]);
    
      }
      DB::commit();
      return Lang::get('auth.deleteSuccess');
    } catch (\Throwable $th) {
      DB::rollBack();
      return $th->getMessage();
    }
  }

  /**
  * Create a function to filter trainings data 
  * @param 
  * @return array
  */
  function deleteUserInvite($value, $getUser){
    try { 
      DB::beginTransaction();
      $config    = config('role.ROLES');
      if($getUser->user_type){
          
          if($config['LHP']['ROLE']){
              DB::delete("delete from `psi_cohort_training_lhp` where `lhp_id` = ? and `cohort_training_id` = ?",[$value['user_id'], $value['cohort_id']]);
              DB::delete("delete from `psi_ct_training_lhp` where `lhp_id` = ? and `candidate_training_id` = ?",[$value['user_id'], $value['ct_training_id']]);
          }

          else if($config['LT']['ROLE']){
              DB::delete("delete from `psi_cohort_training_lt` where `lt_id` = ? and `cohort_training_id` = ?",[$value['user_id'], $value['cohort_id']]);
              DB::delete("delete from `psi_ct_training_lt` where `lt_id` = ? and `candidate_training_id` = ?",[$value['user_id'], $value['ct_training_id']]);
          }

          else if($config['CT']['ROLE']){
              DB::delete("delete from `psi_cohort_training_ct` where `ct_id` = ? and `cohort_training_id` = ?",[$value['user_id'], $value['cohort_id']]);
              DB::delete("delete from `psi_ct_training_ct` where `ct_id` = ? and `candidate_training_id` = ?",[$value['user_id'], $value['ct_training_id']]);
          }

          else if($config['SA']['ROLE']){
              DB::delete("delete from `psi_cohort_training_sa` where `sa_id` = ? and `cohort_training_id` = ?",[$value['user_id'], $value['cohort_id']]);
          }

          else if($config['SL']['ROLE']){
              DB::delete("delete from `psi_cohort_training_sl` where `sl_id` = ? and `cohort_training_id` = ?",[$value['user_id'], $value['cohort_id']]);
          } 
      }
      DB::commit();
      return Lang::get('auth.deleteSuccess');
    } catch (\Throwable $th) {
      DB::rollBack();
      return $th->getMessage();
    }
  } 

  /**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function getUserDetails($currentUser){ 
    return \App\Models\User::select('psi_user.id', 'email','user_type', 'user_name', 'status', 'certification_status', 'organization')
                  ->leftJoin('psi_profile', 'psi_user.id','psi_profile.user_id')
                  ->where('psi_user.id', $currentUser)
                  ->first()->toArray();
  } 
  /**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function sendUserDeleteNotificaiton($sendCTStatus, $userType, $userId, $cohortData, $sendTypeStatus, $slId=''){ 
    $currentUser = '';
    if($userType == Config::get('role.USERS.SL')){
      $saUserData = getUserDetails($userId);
      $currentUser = $slId;
    } 
    else
      $currentUser = $userId;

    if(isset($saUserData))
    $deleteUserData['organization']= $saUserData['organization'];  
    
    $deleteUserData = getUserDetails($currentUser);
    if($deleteUserData){              
      getSADetails($deleteUserData, $userId, $cohortData, $sendTypeStatus);
      getLhpDetails($deleteUserData, $cohortData, $sendTypeStatus);
      if($sendCTStatus == true)
        getCtDetails($deleteUserData, $cohortData, $sendTypeStatus);  
        
      if($userType == Config::get('role.USERS.SL')){ 
        sendUserSlNoti($deleteUserData, $slId, $cohortData, $sendTypeStatus); 
      } 
    }
  }
/**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function getSADetails($deleteUserData, $saId='', $cohortData, $sendTypeStatus){
    $getTemplateData['templateName'] =  Config::get('role.'.$sendTypeStatus.'SA');
    $UserDetails = getUserDetails($saId); 
    if($UserDetails)
      sendFinalNoticationToUser($deleteUserData, $UserDetails, $cohortData, $getTemplateData);            
  }
  /**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function getLhpDetails($deleteUserData, $cohortData, $sendTypeStatus){

    if($cohortData){ 
      $lhpId = array();
      $getTemplateData['templateName'] =  Config::get('role.'.$sendTypeStatus.'LHP');
      $lhpId = \App\Models\CohortTrainingLhp::whereCohortTrainingId($cohortData->id)->first()->toArray();

      $UserDetails = getUserDetails($lhpId['lhp_id']); 
      if($UserDetails)
        sendFinalNoticationToUser($deleteUserData, $UserDetails, $cohortData, $getTemplateData);
    }           
  }
  /**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function sendUserSlNoti($deleteUserData='', $slId='', $cohortData, $sendTypeStatus){

    if($cohortData){ 
      $getTemplateData['templateName'] =  Config::get('role.'.$sendTypeStatus.'SL');
      $UserDetails = getUserDetails($slId);
      if($UserDetails)
        sendFinalNoticationToUser($deleteUserData, $UserDetails, $cohortData, $getTemplateData); 

      return true;
    }           
  }

  
  /**
  * Create a function to get user and related details to send email
  * @param 
  * @return array
  */
  function getCtDetails($deleteUserData, $cohortData, $sendTypeStatus){

    if($cohortData){
      $ctId = array();
      $getTemplateData['templateName'] =  Config::get('role.'.$sendTypeStatus.'CT');
      $ctId = \App\Models\CohortTrainingCt::whereCohortTrainingId($cohortData->id)->first()->toArray();

      $UserDetails = getUserDetails($ctId['ct_id']);
      if($UserDetails)
        sendFinalNoticationToUser($deleteUserData, $UserDetails, $cohortData, $getTemplateData); 
    }
               
  }

}
