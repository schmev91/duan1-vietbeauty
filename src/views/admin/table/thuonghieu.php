<tr id="<?= $ma_th ?>">
    <form action="<?= navigator('thuonghieu', 'update') ?>" method="post">
        <input type="text" hidden name="ma_th" value="<?= $ma_th ?>">
        <td><?= $ma_th ?></td>

        <td><input disabled name="ten_th" type="text" class="form-control p-0  bg-none border-0 text-white " value="<?= $ten_th ?>"></td>
        
        <td><img src="<?= $hinh_th?>" style="max-width: 4.5rem" alt=""></td>

        
        <!-- CỘT CHỨC NĂNG -->
        <td>
            <button type="button" class="updateBtn px-1 p-0 btn btn-light">update</button>
            <button type="submit" hidden class="saveBtn px-2 p-0 btn btn-light bg-golden text-white  border-golden">save</button>
            <a href="<?= navigator('thuonghieu', 'delete') . '&ma_th=' . $ma_th ?>" class="px-1 p-0 btn btn-light">delete</a>
        </td>
    </form>
</tr>