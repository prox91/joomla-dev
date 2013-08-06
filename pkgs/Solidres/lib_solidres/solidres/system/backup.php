<?php
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/

defined('_JEXEC') or die;

/**
 * Backup handler class
 * 
 * @package 	Solidres
 * @subpackage	system
 */
class SRBackup
{
	/**
	 * The database object
	 * 
	 * @var object
	 */
	protected $_db = null;
	
	// Exclude #__reservation_assets and #__categories
	public $listTable = array(
		'#__sr_countries',
		'#__sr_geo_states',
		'#__sr_partners',
		'#__sr_taxes',
		'#__sr_room_types',
		'#__sr_currencies',
		'#__sr_customer_groups',
		'#__sr_coupons',
		'#__sr_reservations',
		'#__sr_invoices',
		'#__sr_media',
		'#__sr_extras',
		'#__sr_prices',
		'#__sr_rooms',
		'#__sr_reservation_room_xref',
		'#__sr_media_reservation_assets_xref',
		'#__sr_media_roomtype_xref',
		'#__sr_reservation_extra_xref',
		'#__sr_reservation_asset_fields',
		'#__sr_customers',
		'#__sr_customer_fields',
		'#__sr_feedback_types',
		'#__sr_feedbacks',
		'#__sr_feedback_conditions',
		'#__sr_feedback_scores',
		'#__sr_invoice_transaction_histories',
		'#__sr_invoice_reservation_histories',
		'#__sr_room_type_coupon_xref',
		'#__sr_payment_methods',
		'#__sr_payment_method_details'
	);
	
	public function __construct()
	{
		$this->_db = JFactory::getDbo();
	}
	
	public function backupSolidres()
	{
		$sql = '';

		foreach ($this->listTable as $tableName)
		{
            $sql .= $this->backupDb($this->_db->quoteName($tableName));
		}
		
		return $sql;
	}
	
	/**
     * Backup Joomla Asset table #__asserts
     * 
     * @return string
     */
    function backupJoomlaAsset()
    {
        $br = "\n";
        $tab = "\t";
        $table = $tab.'<table name=" '.$this->_db->quoteName('#__assets').' ">'.$br;
        $query = $this->_db->getQuery(true);
        $query->clear();
        $query->select('id, parent_id, lft, rgt, level, name, title, rules');
        $query->from($this->_db->quoteName('#__assets'));
        $query->where('name LIKE \'com_solidres%\'');
        $query->order('id ASC');
        $this->_db->setQuery($query);
        $results = $this->_db->loadObjectList();

        if(is_array($results) && count($results) > 0)
        {
            foreach($results as $rs)
            {
                $table .= $tab.$tab.'<row id="'.htmlspecialchars($rs->id).'" parent_id="'.htmlspecialchars($rs->parent_id).'" lft="'.htmlspecialchars($rs->lft).'" rgt="'.htmlspecialchars($rs->rgt).'" level="'.htmlspecialchars($rs->level).'" name="'.htmlspecialchars($rs->name).'" title="'.htmlspecialchars($rs->title).'" rules="'.htmlspecialchars($rs->rules).'">'.$br;

                $query->clear();
                $query->select('id, parent_id, asset_id, lft, rgt, title, alias, description, state, ordering, access, checked_out, checked_out_time, created_by, created_date, modified_by, modified_date, params');
                $query->from($this->_db->quoteName('#__sr_categories'));
                $query->where('asset_id = '.$this->_db->quote($rs->id));
                $this->_db->setQuery($query);
                $categories = $this->_db->loadObjectList();

                if(is_array($categories) && count($categories) > 0)
                {
                    $table .= $tab.$tab.$tab.'<childtable name=" '.$this->_db->quoteName('#__sr_categories').' ">'.$br;
                    foreach($categories as $cat)
                    {
                        $table .= $tab.$tab.$tab.$tab.'<childrow id="'.htmlspecialchars($cat->id).'"
                                        parent_id="'.htmlspecialchars($cat->parent_id).'"
                                        lft="'.htmlspecialchars($cat->lft).'"
                                        rgt="'.htmlspecialchars($cat->rgt).'"
                                        title="'.htmlspecialchars($cat->title).'"
                                        alias="'.htmlspecialchars($cat->alias).'"
                                        description="'.htmlspecialchars($cat->description).'"
                                        state="'.htmlspecialchars($cat->state).'"
                                        ordering="'.htmlspecialchars($cat->ordering).'"
                                        access="'.htmlspecialchars($cat->access).'"
                                        checked_out="'.htmlspecialchars($cat->checked_out).'"
                                        checked_out_time="'.htmlspecialchars($cat->checked_out_time).'"
                                        created_by="'.htmlspecialchars($cat->created_by).'"
                                        created_date="'.htmlspecialchars($cat->created_date).'"
                                        modified_by="'.htmlspecialchars($cat->modified_by).'"
                                        modified_date="'.htmlspecialchars($cat->modified_date).'"
                                        params="'.htmlspecialchars($cat->params).'"/>'.$br;
                    }
                    $table .= $tab.$tab.$tab.'</childtable>'.$br;
                }

                $query->clear();
                $query->select('id, asset_id, category_id, name, alias, address_1');
                $query->select('address_2, city, postcode, phone, description, email');
                $query->select('website, featured, fax, rating, geo_state_id, country_id');
                $query->select('created_date, modified_date, created_by, modified_by, map');
                $query->select('state, checked_out, checked_out_time, ordering, archived');
                $query->select('approved, access, params, language, hits, metakey, metadesc, metadata, xreference');
                $query->from($this->_db->quoteName('#__sr_reservation_assets'));
                $query->where('asset_id = '.$this->_db->quote($rs->id));
                $this->_db->setQuery($query);
                $assets = $this->_db->loadObjectList();

                if(is_array($assets) && count($assets) > 0)
                {
                    $table .= $tab.$tab.$tab.'<childtable name=" '.$this->_db->quoteName('#__sr_reservation_assets').' ">'.$br;
                    foreach($assets as $as)
                    {
                        $table .= $tab.$tab.$tab.$tab.'<childrow id="'.htmlspecialchars($as->id).'"
                                        asset_id="'.htmlspecialchars($as->asset_id).'"
                                        category_id="'.htmlspecialchars($as->category_id).'"
                                        name="'.htmlspecialchars($as->name).'"
                                        alias="'.htmlspecialchars($as->alias).'"
                                        address_1="'.htmlspecialchars($as->address_1).'"
                                        address_2="'.htmlspecialchars($as->address_2).'"
                                        city="'.htmlspecialchars($as->city).'"
                                        postcode="'.htmlspecialchars($as->postcode).'"
                                        phone="'.htmlspecialchars($as->phone).'"
                                        description="'.htmlspecialchars($as->description).'"
                                        email="'.htmlspecialchars($as->email).'"
                                        website="'.htmlspecialchars($as->website).'"
                                        featured="'.htmlspecialchars($as->featured).'"
                                        fax="'.htmlspecialchars($as->fax).'"
                                        rating="'.htmlspecialchars($as->rating).'"
                                        geo_state_id="'.htmlspecialchars($as->geo_state_id).'"
                                        country_id="'.htmlspecialchars($as->country_id).'"
                                        created_date="'.htmlspecialchars($as->created_date).'"
                                        modified_date="'.htmlspecialchars($as->modified_date).'"
                                        created_by="'.htmlspecialchars($as->created_by).'"
                                        modified_by="'.htmlspecialchars($as->modified_by).'"
                                        map="'.htmlspecialchars($as->map).'"
                                        state="'.htmlspecialchars($as->state).'"
                                        checked_out="'.htmlspecialchars($as->checked_out).'"
                                        ordering="'.htmlspecialchars($as->ordering).'"
                                        archived="'.htmlspecialchars($as->archived).'"
                                        approved="'.htmlspecialchars($as->approved).'"
                                        access="'.htmlspecialchars($as->access).'"
                                        params="'.htmlspecialchars($as->params).'"
                                        language="'.htmlspecialchars($as->language).'"
                                        hits="'.htmlspecialchars($as->hits).'"
                                        metakey="'.htmlspecialchars($as->metakey).'"
                                        metadesc="'.htmlspecialchars($as->metadesc).'"
                                        metadata="'.htmlspecialchars($as->metadata).'"
                                        xreference="'.htmlspecialchars($as->xreference).'"
                                        />'.$br;
                    }
                    $table .= $tab.$tab.$tab.'</childtable>'.$br;
                }

                $table .= $tab.$tab.'</row>'.$br;
            }
        }

        $table .= $tab.'</table>'.$br;

        return $table;
    }
    
	public function backupDb($tableName)
    {
    	$utility = SRFactory::get('solidres.utilities.utilities');
    	
    	$br = "\n";
    	
    	$fields = $this->_db->getTableFields($tableName);
        $arrField = array();

        foreach($fields[$tableName] as $k => $v)
        {
            $arrField[] = $k;
        }

        $strQuery = '';
        $tableFields = $utility->myImplodeField($arrField);
        
        $query = $this->_db->getQuery(true);
        $query->clear();
        $query->select('*');
        $query->from($tableName);
        $this->_db->setQuery($query);
        $result = $this->_db->loadRowList();
        
        if(empty($result))
        {
        	return $strQuery.$br.$br.$br;
        }
        
        $strQuery .= 'INSERT INTO `'.$tableName.'` ('.$tableFields.') VALUES'.$br;
        
        for ($i = 0; $i < count($result); $i++)
        {
        	$rsValues = $utility->myImplode($result[$i]);
        	$strQuery .= '('.$rsValues.')';

        	if($i == count($result) - 1)
            {
        		$strQuery .= ';'.$br;
        	}
            else
            {
        		$strQuery .= ','.$br;
        	}
        }
        
        return $strQuery.$br.$br.$br;
    }
}