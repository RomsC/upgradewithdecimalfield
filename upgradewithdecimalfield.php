<?php

declare(strict_types=1);

use UpgradeWithDecimalField\Install\Installer;

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once __DIR__.'/vendor/autoload.php';
}

class UpgradeWithDecimalField extends Module
{
    public function __construct()
    {
        $this->name = 'upgradewithdecimalfield';
        $this->author = 'Romain Couderc';
        $this->version = '1.0.0';
        $this->ps_versions_compliancy = ['min' => '1.7.7', 'max' => _PS_VERSION_];

        parent::__construct();

        $this->displayName = $this->l('Upgrade with DECIMAL field');
        $this->description = $this->l('Expose the autoupgrade issue with DECIMAL field in database.');
    }

    public function install()
    {
        return $this->installTables()
            && parent::install();
    }

    public function uninstall()
    {
        return $this->removeTables() && parent::uninstall();
    }

    /**
     * @return bool
     */
    private function installTables()
    {
        /** @var Installer $installer */
        $installer = $this->getInstaller();
        $errors = $installer->createTables();

        return empty($errors);
    }

    /**
     * @return bool
     */
    private function removeTables()
    {
        /** @var Installer $installer */
        $installer = $this->getInstaller();
        $errors = $installer->dropTables();

        return empty($errors);
    }

    /**
     * @return Installer
     */
    private function getInstaller()
    {
        try {
            $installer = $this->get('prestashop.module.upgradewithdecimalfield.install');
        } catch (Exception $e) {
            $installer = null;
        }

        if (!$installer) {
            $installer = new Installer(
                $this->get('doctrine.dbal.default_connection'),
                $this->getContainer()->getParameter('database_prefix')
            );
        }

        return $installer;
    }
}