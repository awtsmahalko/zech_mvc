<?=sidebar_li("DASHBOARD","home",$active_li,"fa-tachometer")?>
<li class="nav-item has-treeview <?=sidebar_parent($active_li,$tree_module,1)?>">
  <a href="#" class="nav-link <?=sidebar_parent($active_li,$tree_module)?>">
    <?=sidebar_ul("MOTHER MODULE")?>
  </a>
  <ul class="nav nav-treeview">
    <?=sidebar_li("Module 1","module-link",$active_li)?>
  </ul>
</li>