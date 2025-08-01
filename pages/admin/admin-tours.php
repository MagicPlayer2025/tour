<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/function.php') ?>
<?php $tours = getAllTours(); ?>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="/assets/css/template.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Teko:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/catalog.css"> 
    <link rel="stylesheet" href="/assets/css/admin-template.css"> 
    <title>GoTourist - Админ панель </title>
</head>
<body>
    <div class="wrapper">
        <header class="header_admin">
            <p>GoTourist</p>
            <h1>Админ панель</h1>
        </header>

        <div class="container-fluid">
            <div class="row">
    <!-- Сайдбар -->
            <div class="col-md-2 p-3 sidebar-admin">
                  
                <ul class="nav flex-column">
                    <li class="nav-item">
                         <a class="nav-link " href="admin-catalog.php">Услуги</a>
                     </li>
                     <li class="nav-item">
                      <a class="nav-link" href="admin-articles.php">Статьи</a>
                 </li>
                    <li class="nav-item">
                     <a class="nav-link  " href="admin-reviews.php">Отзывы</a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-discount.php">Акции</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-active" href="admin-tours.php">Туры</a>
                </li>
                <li class="nav-item"> 
                    <a class="exit" href="/assets/vendor/admin/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Выход</a>
                </li>
             </ul>
            </div>
    
    <!-- Основной контент -->
         <div class="col-md-10 p-3">
             <h1 class="text-center">Туры</h1>
             
              <?php if (isset($_SESSION['admin_message'])) { ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['admin_message']); ?></div>
                        <?php unset($_SESSION['admin_message']); ?>
                    <?php } ?>
                    <?php if (isset($_SESSION['admin_error'])) { ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['admin_error']); ?></div>
                        <?php unset($_SESSION['admin_error']); ?>
                    <?php } ?>
                    <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
                 <div class="alert alert-success">Запись успешно удалена!</div>
             <?php endif; ?>
             
             <?php if (isset($_GET['success']) && $_GET['success'] === 'updated'): ?>
                 <div class="alert alert-success">Запись успешно обновлена!</div>
             <?php endif; ?>
             
             <?php if (isset($_GET['error'])): ?>
                 <div class="alert alert-danger">Произошла ошибка при выполнении операции.</div>
             <?php endif; ?>
             
             <a href="/assets/vendor/admin/add-tours.php" class="btn btn-success mb-3">Добавить тур</a>
             <table class="admin-table">
                <thead>
                    <tr  class="table-one">
                        <th>ID</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Изображение</th>
                        <th>Отправление</th>
                        <th>Прибытие</th>
                        <th>Ночей</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tours as $tour) { ?>
                        <tr class="tr-base">
                            <td><?php echo $tour['id'] ?></td>
                            <td><?php echo htmlspecialchars($tour['title']) ?></td>
                            <td><p><?php echo htmlspecialchars($tour['description']) ?></p></td>
                            <td><img src="../<?php echo htmlspecialchars($tour['image_url']) ?>" alt="" style="max-width:100px;"></td>
                            <td><?php echo htmlspecialchars($tour['departure_city']) ?></td>
                             <td><?php echo htmlspecialchars($tour['arrival_city']) ?></td>
                              <td><?php echo htmlspecialchars($tour['nights']) ?></td>
                            <td>
                                <div class="admin-btn">
                                    <a href="/assets/vendor/admin/edit-tours.php?id=<?php echo $tour['id']; ?>" class="insert-btn">Редактировать</a>
                                    <form method="POST" action="/assets/vendor/admin/delete-tours.php" class="delete-form d-inline">
                                        <input type="hidden" name="tour_id" value="<?php echo $tour['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить этот тур?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
     </div>
    </div>


    </div>
    

</body>
</html>