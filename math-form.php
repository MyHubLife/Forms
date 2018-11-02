<form method="POST" action = "<?= $form->encode($_SERVER['PHP_SELF']) ?>">
    <table>
        <?php if ($errors) { ?>
        <tr>
            <td>You need to correct following errors</td>
            <td><ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $form-> encode ($error) ?></li>
                    <?php } ?>
            </ul></td>
        </tr>
        <?php } ?>

        <tr><td>First number:</td>
                <td><?= $form->input('text', ['name' => 'num1']) ?></td>
        </tr>
        <tr><td>Operation:</td>
            <td><?= $form->select($GLOBALS['ops'], ['name' => 'op']) ?></td>
        </tr>
        <tr><td>Second number:</td>
            <td><?= $form->input('text', ['name' => 'num2']) ?></td>
        </tr>

        <tr><td colspan="2" align="center">
        <?= $form->input('submit', ['value' => 'Calculate']) ?>
        </td> </tr>

    </table>
</form>

