<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File manager</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <table class="table table-bordered">
        <?php foreach(get_files() as $file_info=>$files): ?>
            <tr>
                <td>
                    <?php if($file_info['is_dir']): ?>
                        <a href="<?='?go_to='.$file_info['file_path']?>"><?=$files; ?></a>
                    <?php else : ?>
                        <a href="<?='?open='.$file_info['file_path']?>"><?=$files; ?></a>
                    <?php endif; ?>
                </td>
                <td><?=$file_info['is_dir']?'Dir': 'File'; ?></td>
                <td><?=$file_info['file_size']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if ($opened_file !==null and $opened_file['type']!=='jpg' ): ?>
        <form method="post">
            <div class="form-group">
                <label for="name"><?=$opened_file['file_name'];?></label>
                <textarea class="form-control" name="content" id="name" rows="10">
                        <?=$opened_file['content'] ;?>
                </textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php endif; ?>
    <?php if ($opened_file['type']=='jpg'): ?>
    <img src='<?= $opened_file['file_name']; ?>'>
    <?php endif; ?>
</div>
</body>
</html>