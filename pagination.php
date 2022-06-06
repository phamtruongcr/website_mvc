<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
        <li class="page-item <?php if ($current_page <= 1){echo "disabled";}?>">
          <a class="page-link" href="?page=<?= $current_page-1 ?>" tabindex="-1">Previous</a>
        </li>

        <?php if ($current_page > 3): ?>
            <a class="page-link" href="?page=1">1</a>
            <a class="page-link">...</a>
        <?php endif ?>

        <?php for ($i = 1; $i <= $total_pages; ++$i) {
          
         ?>
         <?php if ($i > $current_page-3 && $i < $current_page+3): ?>
          <li class="page-item <?php if ($i==$current_page): ?><?= 'active' ?><?php endif ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>  
         <?php endif ?>
        
        <?php } ?>

        <?php if ($current_page < $total_pages-3): ?>
            <a class="page-link" >...</a>
            <a class="page-link" href="?page=<?= $total_pages ?>"><?= $total_pages ?></a>
        <?php endif ?>

        <li class="page-item <?php if ($current_page >= $total_pages){echo "disabled";}?>">
          <a class="page-link" href="?page=<?= $current_page+1 ?>">Next</a>
        </li>
      </ul>
    </nav>

