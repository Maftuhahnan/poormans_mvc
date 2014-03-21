<div class="full_w">
    <div class="h_title">Cities Table</div>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvolupt</p>
    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Country ID</th>
                <th scope="col">Last Update</th>
            </tr>
        </thead>
        <tbody>
            <?php $n = 1; foreach($cities as $city): ?>
            <tr>
                <td class="align-center"><?php echo $n++; ?></td>
                <td><?php echo $city->city; ?></td>
                <td><?php echo $city->country; ?></td>
                <td><?php echo $city->last_update; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>