<?php
class ds_base extends CModule
{
    public function __construct()
    {
        $this->MODULE_ID = str_replace('_', '.', __CLASS__);
        $this->MODULE_NAME = __CLASS__;
        $this->MODULE_DESCRIPTION = __CLASS__;
        $this->MODULE_SORT = 100;
        $this->PARTNER_NAME = 'Project api';
        $this->PARTNER_URI = '#';
        if(method_exists($this, 'GetModuleRightList') && !empty($rightList = $this->GetModuleRightList()) && is_array($rightList)) {
            $this->MODULE_GROUP_RIGHTS = "Y";
        }
        if(file_exists(__DIR__.'/../version.php')) {
            include __DIR__.'/../version.php';
            if(isset($arModuleVersion) && !empty($arModuleVersion) && is_array($arModuleVersion)) {
                $this->MODULE_VERSION = $arModuleVersion['VERSION'];
                $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
            }
        }
    }

    function DoInstall()
    {
        if(!$this->IsInstalled()) {
            $this->Add();
        }
    }

    function DoUninstall()
    {
        if($this->IsInstalled()) {
            $this->Remove();
        }
    }

}