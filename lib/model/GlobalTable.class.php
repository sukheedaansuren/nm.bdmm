<?php

/**
 * CouponTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class GlobalTable extends Doctrine_Table
{
    public static function doExecute($tableName, $params = array())
    {
        $q = Doctrine_Query::create()->select('*');
        $q = self::params($tableName, $q, $params);
        return $q->execute();
    }
    
  
    public static function doFetchArray($tableName, $params = array())
    {
        $q = Doctrine_Query::create()->select('*');
        $q = self::params($tableName, $q, $params);
        return $q->fetchArray();
    }
    
    
    public static function doFetchSelection($tableName, $fieldName, $params = array())
    {
        $res = array();
        $rss = self::doFetchArray($tableName, $params);
        foreach ($rss as $rs) 
        {
            $res[$rs['id']] = $fieldName;
        }
        return $res;
    }
  
    
    public static function doFetchOne($tableName, $params = array())
    {
        $q = Doctrine_Query::create()->select('*');
        $q = self::params($tableName, $q, $params);
        return $q->fetchOne();
    }
    
    
    public static function getPager($tableName, $params = array(), $page=1)
    {
        $q = Doctrine_Query::create()->select('*');
        $q = self::params($tableName, $q, $params);

        $pager = new sfDoctrinePager($tableName, sfConfig::get('app_pager', 30));
        $pager->setPage($page);
        $pager->setQuery($q);
        $pager->init();
        
        return $pager;
    }
    
    public static function doCount($tableName, $params = array())
    {
        $q = Doctrine_Query::create()->select('count(id)');
        $q = self::params($tableName, $q, $params);
        return $q->count();
    }
    
    private static function params($tableName, $q, $params = array())
    {
        $q->from($tableName);

        # id
        if(isset($params['id']) && $params['id'] != null)
            $q->andWhere('id = ?', $params['id']);
            
        if(isset($params['idO']) && $params['idO'] != null)
            $q->andWhere('id <> ?', $params['idO']);

        if(isset($params['ids']) && sizeof($params['ids']))
            $q->andWhereIn('id', $params['ids']);

        if(isset($params['idsO']) && sizeof($params['idsO']))
            $q->andWhereNotIn('id', $params['idsO']);
            
        # route
        if(isset($params['route']) && $params['route'] != null)
            $q->andWhere('route= ?', $params['route']);

        if(isset($params['type']) && $params['type'] != null)
            $q->andWhere('type= ?', $params['type']);
            
        if(isset($params['typeO']) && $params['typeO'] != null)
            $q->andWhere('type <> ?', $params['typeO']);

            
        # parentId
        if(isset($params['parentId']) && $params['parentId'] != null)
            $q->andWhere('parent_id = ? ', $params['parentId']);
            
        if(isset($params['categoryId']) && $params['categoryId'] != null)
            $q->andWhere('category_id = ?', $params['categoryId']);

        # categoryId
        if(isset($params['categoryId']) && $params['categoryId'] != null)
            $q->andWhere('category_id = ?', $params['categoryId']);
            
        if(isset($params['categoryIdO']) && $params['categoryIdO'] != null)
            $q->andWhere('category_id <> ?', $params['categoryIdO']);
            
        if(isset($params['categoryIds']) && $params['categoryIds'] != null)
            $q->andWhereIn('category_id', $params['categoryIds']);

        # isActive
        if(isset($params['isActive'])) {
            if($params['isActive'] != "all" && in_array($params['isActive'], array('0', '1'))) // all ued filter hiihgui
                $q->andWhere('is_active = ?', $params['isActive']);
        } else {
            $q->andWhere('is_active = ?', 1);
        }
        
        # isFeatured
        if(isset($params['isFeatured']) && in_array($params['isFeatured'], array('0', '1'))) 
            $q->andWhere('is_featured = ?', 1);
        if(isset($params['isTop']) && in_array($params['isTop'], array('0', '1'))) 
            $q->andWhere('is_top = ?', 1);
        if(isset($params['isNew']) && in_array($params['isNew'], array('0', '1'))) 
            $q->andWhere('is_new = ?', 1);
        if(isset($params['isDiscuss']) && in_array($params['isDiscuss'], array('0', '1'))) 
            $q->andWhere('is_discuss = ?', 1);

        # keyword
        if(isset($params['sTeam']) && $params['sTeam'] != null)
            $q->andWhere('name LIKE ? ', array('%'.$params['teamKeyword'].'%'));
        if(isset($params['sPlayer']) && $params['sPlayer'] != null)
            $q->andWhere('fullname LIKE ? ', array('%'.$params['playerKeyword'].'%'));
        if(isset($params['sNews']) && $params['sNews'] != null)
            $q->andWhere('title LIKE ? OR summary LIKE ? OR body LIKE ?', array('%'.$params['sNews'].'%','%'.$params['sNews'].'%','%'.$params['sNews'].'%'));

        # group, order, limit
        if(isset($params['groupBy']) && $params['groupBy']) 
            $q->groupBy($params['groupBy']);

        if(isset($params['offset']) && $params['offset'])
            $q->offset($params['offset']);
        
        $limit = isset($params['limit']) ? $params['limit'] : sfConfig::get('app_limit', 30);
        $q->limit($limit);
  
        $order = isset($params['orderBy']) ? $params['orderBy'] : 'created_at DESC';
        $q->orderBy($order);

        return $q;
    }

}