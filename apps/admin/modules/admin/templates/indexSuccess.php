<form action="<?php echo url_for('admin/index')?>" method="GET">
    <?php include_partial('partial/search', array());?>
</form>

<br clear="all">
<br clear="all">
<table width="100%">
  <thead>
    <tr>
      <th>#</th>
      <th>Email</th>      
      <th>Module permissions</th>      
      <th>Last logged at</th>
      <th>Sort</th>
      <th>Date</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0; foreach ($pager->getResults() as $rs): ?>
	    <tr <?php if($i%2 != 0) echo 'class="odd"'?> style="<?php if(!$rs->getIsActive()) echo 'background:#cdcdcd;'?>">
	      <td><?php echo ++$i?></td>
	      <td><a href="<?php echo url_for('admin/edit?id='.$rs->getId())?>"><?php echo $rs->getEmail() ?></a></td>
	      <td width="20%"><?php echo $rs->getModPermissions() ?></td>
	      <td nowrap><?php echo $rs->getLoggedAt() ?></td>
	      <td nowrap><?php echo $rs->getSort() ?></td>
				<td nowrap>
				    Created at: <?php echo time_ago($rs->getCreatedAt()) ?><br>
				    Updated at: <?php echo time_ago($rs->getUpdatedAt()) ?>
				</td>
	      <td nowrap>
	          <?php include_partial('partial/isActive', array('module'=>'admin', 'rs'=>$rs));?>
	          <?php include_partial('partial/editDelete', array('module'=>'admin', 'id'=>$rs->getId()));?>
	      </td>
	    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo pager($pager, 'admin/index?s='.$sf_params->get('s'))?>