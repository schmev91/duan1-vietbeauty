<tr id="<?= $ma_nd ?>">
    <form action="<?= navigator('nguoidung', 'update') ?>" method="post">
        <input type="text" hidden name="ma_nd" value="<?= $ma_nd ?>">
        <td><?= $ma_nd ?></td>
        <td>
            <select disabled class="form-select p-0 bg-none border-0 text-white" name="isAdmin">
                <option value="<?= $isAdmin ?>" selected><?= boolval($isAdmin) ? 'true' : 'false'  ?></option>
                <option value="<?= $isAdmin == 0 ? 1 : 0 ?>"><?= !boolval($isAdmin) ? 'true' : 'false' ?></option>
            </select>
        </td>
        <td>
            <select disabled class="form-select p-0 bg-none border-0 text-white" name="isBanned">
                <option value="<?= $isBanned  ?>" selected><?= boolval($isBanned)  ? 'true' : 'false' ?></option>
                <option value="<?= $isBanned == 0 ? 1 : 0 ?>"><?= !boolval($isBanned) ? 'true' : 'false' ?></option>
            </select>
        </td>
        <td>
            <img src="<?= $avatar ?>" style="width: 2rem;height: 2rem; border-radius: 50%; object-fit: cover;" alt="">
        </td>
        <td><input disabled name="ten_nd" type="text" class="form-control p-0  bg-none border-0 text-white " value="<?= $ten_nd ?>"></td>
        <td><input disabled name="email" type="text" class="form-control p-0  bg-none border-0 text-white " value="<?= $email ?>"></td>
        <td><input disabled name="sdt" type="text" class="form-control p-0  bg-none border-0 text-white " value="<?= $sdt ?>"></td>
        <td><input disabled name="diachi" type="text" class="form-control p-0  bg-none border-0 text-white " value="<?= $diachi ?>"></td>
        <!-- CỘT CHỨC NĂNG -->
        <td>
            <button type="button" class="updateBtn px-1 p-0 btn btn-light">update</button>
            <button type="submit" hidden class="saveBtn px-2 p-0 btn btn-light bg-golden text-white  border-golden">save</button>
            <a href="<?= navigator('nguoidung', 'delete') . '&ma_nd=' . $ma_nd ?>" class="px-1 p-0 btn btn-light">delete</a>
        </td>
    </form>
</tr>