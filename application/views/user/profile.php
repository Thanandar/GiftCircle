
<div class="span16">


   <h3>Email Address</h3>
   <p><?php echo $user->email ?></p>

   <h3>Login Activity</h3>
   <p>Last login was <?php echo date('F jS, Y', $user->last_login) ?>, at <?php echo date('h:i:s a', $user->last_login) ?>.<br/>Total logins: <?php echo $user->logins ?></p>

   <?php
   $providers = array_filter(Kohana::$config->load('useradmin.providers'));
   $identities = $user->user_identity->find_all();
   if($identities->count() > 0) {
      echo '<h3>Accounts associated with your user profile</h3><p>';
      foreach($identities as $identity) {
         echo '<a class="associated_account" style="background: #FFF url(/img/small/'.$identity->provider.'.png) no-repeat center center"></a>';
         unset($providers[$identity->provider]);
      }
      echo '<br style="clear: both;"></p>';
   }
   if(!empty($providers)) {
      echo '<h3>Additional account providers</h3><p>Click the provider icon to associate it with your existing account.</p><p>';
      foreach($providers as $provider => $enabled) {
         echo '<a class="associated_account '.$provider.'" href="'.URL::site('/user/associate/'.$provider).'"></a>';
      }
      echo '<br style="clear: both;"></p>';
   }
   ?>

   <div class="well">
      <input class="btn" type="button" onclick="location.href='/user/profile_edit'" value="Edit profile" />
      <input class="btn danger" type="button" onclick="location.href='/user/unregister'" value="Delete account" />
   </div>

</div>
