<?php

use yii\db\Migration;
use backend\models\User;

/**
 * Class m200802_163903_create_rbac_data
 */
class m200802_163903_create_rbac_data extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        
        // Define permissions
        
        $viewComplaintsListPermission = $auth->createPermission('viewComplaintsList');
        $auth->add($viewComplaintsListPermission);
        
        $viewPostPermission = $auth->createPermission('viewPost');
        $auth->add($viewPostPermission);
        
        $deletePostPermission = $auth->createPermission('deletePost');
        $auth->add($deletePostPermission);
        
        $approvePostPermission = $auth->createPermission('approvePost');
        $auth->add($approvePostPermission);
        
        $viewUsersListPermission = $auth->createPermission('viewUsersList');
        $auth->add($viewUsersListPermission);
        
        $viewUserPermission = $auth->createPermission('viewUser');
        $auth->add($viewUserPermission);
        
        $deleteUserPermission = $auth->createPermission('deleteUser');
        $auth->add($deleteUserPermission);
        
        $updateUserPermission = $auth->createPermission('updateUser');
        $auth->add($updateUserPermission);

        // Define roles
        
        $moderatorRole = $auth->createRole('moderator');
        $auth->add($moderatorRole);
        
        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        // Define roles - permissions relations
        
        $auth->addChild($moderatorRole, $viewComplaintsListPermission);
        $auth->addChild($moderatorRole, $viewPostPermission);
        $auth->addChild($moderatorRole, $deletePostPermission);
        $auth->addChild($moderatorRole, $approvePostPermission);
        $auth->addChild($moderatorRole, $viewUsersListPermission);
        $auth->addChild($moderatorRole, $viewUserPermission);
        
        $auth->addChild($adminRole, $moderatorRole);
        $auth->addChild($adminRole, $deleteUserPermission);
        $auth->addChild($adminRole, $updateUserPermission);
        
        // Create admin user
        /*$user = new User([
            'email' => 'vabeya7301@icanav.net',
            'username' => 'Admin',
            'password_hash' => '$2y$13$RzHTep.G5GLBj6cHKF4H/eUCGgdNqfdpifGoHaWtsFA9DhEEoVSVW',
        ]);
        $user->generateAuthKey();
        $user->save();*/

        // Add admin role to user 
        $auth->assign($adminRole, 1004);
    }

    public function safeDown()
    {
        echo "m200802_163903_create_rbac_data cannot be reverted.\n";

        return false;
    }
}
