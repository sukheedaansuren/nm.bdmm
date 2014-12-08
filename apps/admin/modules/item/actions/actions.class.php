<?php

/**
 * item actions.
 *
 * @package    vogue
 * @subpackage item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itemActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $params = array();
        if($request->getParameter('type')) $params['type'] = $request->getParameter('type');
        if($request->getParameter('s')) $params['sItem'] = $request->getParameter('s');
        $this->pager = GlobalTable::getPager('Item', array('*'), $params, $request->getParameter('page'));
        
    }
  
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new ItemForm();
    }
  
    public function executeCreate(sfWebRequest $request)
    {        
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ItemForm();
    
        $this->processForm($request, $this->form);
    
        $this->setTemplate('new');
    }
  
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($rs = Doctrine::getTable('Item')->find(array($request->getParameter('id'))), sprintf('Object page does not exist (%s).', $request->getParameter('id')));
        $this->form = new ItemForm($rs);
    }
  
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($rs = Doctrine::getTable('Item')->find(array($request->getParameter('id'))), sprintf('Object page does not exist (%s).', $request->getParameter('id')));
        $this->form = new ItemForm($rs);
    
        $this->processForm($request, $this->form);
    
        $this->setTemplate('edit');
    }
  
    /** not used yet
    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($rs = Doctrine::getTable('Item')->find(array($request->getParameter('id'))), sprintf('Object page does not exist (%s).', $request->getParameter('id')));
        $rs->delete();
        $this->getUser()->setFlash('flash', 'Successfully deleted.', true);
        $this->redirect($request->getReferer() ? $request->getReferer() : 'item/index');
    }*/
    

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $rs = $form->save();
            $rs->setGenre(join(";", $request->getParameter('genres')));
            // image
            GlobalLib::createThumbs($rs->getImage(), $rs->getFolder(), array(140));
            if($rs->getImage() && file_exists(sfConfig::get('sf_upload_dir').'/'.$rs->getFolder().'/'.$rs->getImage())) {
            		// create waterlink
		            $filepath = sfConfig::get('sf_upload_dir').'/'.$rs->getFolder().'/'.$rs->getImage();
		            $img = new sfImage($filepath);
		            $img->overlay(new sfImage(sfConfig::get('sf_web_dir').'/images/watermark200.png'), 'bottom-right');
		            $img->saveAs($filepath);
            }
            
            // title
            $rs->setTitle(trim($rs->getTitle()));
            $rs->setTitleMn(trim($rs->getTitleMn()));
            if($rs->getTitle()) {
                $rs->setRoute(GlobalLib::slugify(GlobalLib::mn2en($rs->getTitle().'-'.$rs->getYear())));
            }
            $rs->setSummary(trim($rs->getSummary()));
            $rs->setSummaryMn(trim($rs->getSummaryMn()));
            $rs->setBody(trim($rs->getBody()));
            $rs->setBodyMn(trim($rs->getBodyMn()));
            $rs->setTrailer(trim($rs->getTrailer()));
            $rs->setRating(trim($rs->getRating()));
            $rs->setKickass(trim($rs->getKickass()));
						// casts            
            $rs->setCasts(trim($rs->getCasts()));
            $tmp = explode(',', $rs->getCasts());
            foreach($tmp as $t) {
                $route = GlobalLib::slugify(GlobalLib::mn2en(trim($t)));
            		if(!GlobalTable::doFetchOne('Celebrity', array('id'), array('route'=>$route, 'limit'=>1))) {
            				$c = new Celebrity();
            				$c->setFullname(trim($t));
            				$rs->setRoute($route);
            				$c->save();
            		}
            }
            // studio
            $rs->setStudios(trim($rs->getStudios()));
            $tmp = explode(',', $rs->getStudios());
            foreach($tmp as $t) {
                $route = GlobalLib::slugify(GlobalLib::mn2en(trim($t)));
            		if(!GlobalTable::doFetchOne('Studio', array('id'), array('route'=>$route, 'limit'=>1))) {
            				$c = new Studio();
            				$c->setName(trim($t));
            				$rs->setRoute($route);
            				$c->save();
            		}
            }
            // director
            $rs->setDirector(trim($rs->getDirector()));
            $tmp = explode(',', $rs->getDirector());
            foreach($tmp as $t) {
                $route = GlobalLib::slugify(GlobalLib::mn2en(trim($t)));
            		if(!GlobalTable::doFetchOne('Celebrity', array('id'), array('route'=>$route, 'limit'=>1))) {
            				$c = new Celebrity();
            				$c->setFullname(trim($t));
            				$rs->setRoute($route);
            				$c->save();
            		}
            }
            // writer
            $rs->setWriter(trim($rs->getWriter()));
            $tmp = explode(',', $rs->getWriter());
            foreach($tmp as $t) {
                $route = GlobalLib::slugify(GlobalLib::mn2en(trim($t)));
            		if(!GlobalTable::doFetchOne('Celebrity', array('id'), array('route'=>$route, 'limit'=>1))) {
            				$c = new Celebrity();
            				$c->setFullname(trim($t));
            				$rs->setRoute($route);
            				$c->save();
            		}
            }
            $rs->setDuration(trim($rs->getDuration()));
            $rs->setAge(trim($rs->getAge()));
            $rs->setOfficialLink1(trim($rs->getOfficialLink1()));
            $rs->setOfficialLink2(trim($rs->getOfficialLink2()));
            $rs->setSource(trim($rs->getSource()));
            $rs->save();

            $this->getUser()->setFlash('flash', 'Successfully saved.', true);
            $this->redirect('item/index');
        }
    }


}
