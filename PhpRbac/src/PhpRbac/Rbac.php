<?php
namespace PhpRbac;

use \Jf;

/**
 * @file
 * Provides NIST Level 2 Standard Role Based Access Control functionality
 *
 * @defgroup phprbac Rbac Functionality
 * @{
 * Documentation for all PhpRbac related functionality.
 */
class Rbac
{
	const RBAC_ADAPTER_PDO = 'pdo_mysql';
	const RBAC_ADAPTER_MYSQL = 'mysqli';
	const RBAC_ADAPTER_SQLITE = 'pdo_sqlite';

	public function __construct($dbAdapter,
								$dbHost,
								$dbUser,
								$dbPassword,
								$dbName,
								$dbTablePrefix = 'phprbac_',
								$unit_test = '')
	{

		if ((string) $unit_test === 'unit_test') {
			require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
		} else {
			$host=$dbHost;
			$user=$dbUser;
			$pass=$dbPassword;

			$dbname=$dbName;

			if (($dbAdapter === 'pdo_mysql') || ($dbAdapter === 'mysqli') || ($dbAdapter === 'pdo_sqlite')) {
				$adapter = $dbAdapter;
			} else {
				throw new \Exception('wrong specified adapter for database');
			}

			$tablePrefix = $dbTablePrefix;
		}

		require_once 'core/lib/Jf.php';

		$this->Permissions = Jf::$Rbac->Permissions;
		$this->Roles = Jf::$Rbac->Roles;
		$this->Users = Jf::$Rbac->Users;
	}

    public function assign($role, $permission)
    {
        return Jf::$Rbac->assign($role, $permission);
    }

    public function check($permission, $user_id)
    {
        return Jf::$Rbac->check($permission, $user_id);
    }

    public function enforce($permission, $user_id)
    {
        return Jf::$Rbac->enforce($permission, $user_id);
    }

    public function reset($ensure = false)
    {
        return Jf::$Rbac->reset($ensure);
    }

    public function tablePrefix()
    {
        return Jf::$Rbac->tablePrefix();
    }
}

/** @} */ // End group phprbac */
