<?php

/**
 * PageTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PageTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PageTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Page');
    }
    
    private static function params($q, $params = array())
    {
        $q->from('Page');
        
        # type
        if(isset($params['type']) && $params['type'] != null)
            $q->andWhere('type = ?', $params['type']);
        
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
            $q->andWhere('title LIKE ?', array('%'.$params['s'].'%'));

        # group, offset, limit, order
        if(isset($params['groupBy']) && $params['groupBy']) 
            $q->groupBy($params['groupBy']);

        if(isset($params['offset']) && $params['offset'])
            $q->offset($params['offset']);
        
        $limit = isset($params['limit']) ? $params['limit'] : sfConfig::get('app_limit', 30);
        $q->limit($limit);
  
        $order = isset($params['orderBy']) ? $params['orderBy'] : 'sort DESC, created_at DESC';
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

        $pager = new sfDoctrinePager(sfConfig::get('app_pager', 30));
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