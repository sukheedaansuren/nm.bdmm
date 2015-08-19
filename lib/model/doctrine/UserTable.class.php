<?php

/**
 * UserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class UserTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object UserTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('User');
    }
    
    private static function params($q, $params = array())
    {
        $q->from('User');
            
        # email
        if(isset($params['email']) && $params['email'] != null)
            $q->andWhere('email =?', $params['email']);
            
        # fullname
        if(isset($params['fullname']) && $params['fullname'] != null)
            $q->andWhere('fullname = ? ', $params['fullname']);
            
        # userId
        if(isset($params['userId']) && $params['userId'] != null)
            $q->andWhere('user_id = ? ', $params['userId']);
            
        # itemId
        if(isset($params['itemId']) && $params['itemId'] != null)
            $q->andWhere('item_id = ? ', $params['itemId']);

        # isActive
        if(isset($params['isActive'])) {
            if($params['isActive'] != "all" && in_array($params['isActive'], array('0', '1')))
                $q->andWhere('is_active = ?', $params['isActive']);
        } else {
            $q->andWhere('is_active = ?', 1);
        }
        
        # isFeatured
        if(isset($params['isFeatured']) && in_array($params['isFeatured'], array('0', '1'))) 
            $q->andWhere('is_featured = ?', 1);
		
        # keyword
        if(isset($params['s']) && $params['s'] != null)
            $q->andWhere('position LIKE ?', array('%'.$params['s'].'%'));

        # group, offset, limit, order
        if(isset($params['groupBy']) && $params['groupBy']) 
            $q->groupBy($params['groupBy']);

        if(isset($params['offset']) && $params['offset'])
            $q->offset($params['offset']);
        
        $limit = isset($params['limit']) ? $params['limit'] : sfConfig::get('app_pager', 30);
        $q->limit($limit);
  
        $order = isset($params['orderBy']) ? $params['orderBy'] : 'created_at DESC';
        $q->orderBy($order);

        return $q;
    }
    

    public static function doExecute($columns = array(), $params = array())
    {
        $q = Doctrine_Query::create()->select(join(',', $columns));
        $q = self::params($q, $params);
        return $q->execute();
    }
    
  
    public static function doFetchArray($columns = array(), $params = array())
    {
        $q = Doctrine_Query::create()->select(join(',', $columns));
        $q = self::params($q, $params);
        return $q->fetchArray();
    }
    
    
    public static function doFetchSelection($fieldName, $columns = array(), $params = array())
    {
        $res = array();
        $rss = self::doFetchArray($columns, $params);
        foreach ($rss as $rs) 
        {
            $res[$rs['id']] = $rs[$fieldName];
        }
        return $res;
    }
  
    public static function doFetchOne($columns = array(), $params = array())
    {
        $q = Doctrine_Query::create()->select(join(',', $columns));
        $params['limit'] = 1;
        $q = self::params($q, $params);
        return $q->fetchOne();
    }
    
    
    public static function getPager($columns = array(), $params = array(), $page=1)
    {
        $q = Doctrine_Query::create()->select(join(',', $columns));
        $q = self::params($q, $params);

        $pager = new sfDoctrinePager(isset($params['limit']) ? $params['limit'] : sfConfig::get('app_pager', 30));
        $pager->setPage($page);
        $pager->setQuery($q);
        $pager->init();
        
        return $pager;
    }
    
    public static function doCount($params = array())
    {
        $q = Doctrine_Query::create()->select('count(id)');
        $q = self::params($q, $params);
        return $q->count();
    }
}