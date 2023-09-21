<?php require_once APPROOT . '/src/views/include/header.php'; ?>
    <h1 class="text-center pt-3">Add Members</h1>
    <h2 class="text-center">Add a new member to the database</h2>
    <hr>
    <h3 class="text-center">Add a new member</h3>
    <div class="container justify-content-center mx-auto">
    <div class="container text-center">
    <div class="row justify-content-center mx-auto">
        <div class="col-md-6">
            <form action="<?= URLROOT; ?>/test/add-member" method="post">
                <div class="mb-3 text-center">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                </div>

                <div class="mb-3 text-center">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>

                <div class="mb-3 text-center">
                    <label for="school_id" class="form-label">School</label>
                    <select class="form-select" name="school_id" id="school_id">
                        <?php foreach ($schools as $school) : ?>
                            <option value="<?=$school->id;?>"><?=$school->name;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Add Member">
                </div>
            </form>
        </div>
    </div>
</div>


<h1 class="text-center">Members by School</h1>
<hr>

<div class="container text-center">
    <!-- School Selector Dropdown -->
    <div class="row justify-content-center mx-auto">
        <div class="col-md-6">
            <h3 class="text-center">Select a School</h3>
            <form action="<?= URLROOT; ?>/test/tasks" method="post">
                <div class="mb-3 text-center justify-content-center ">
                    <label for="school_filter" class="form-label">Select School</label>
                    <select class="form-select " name="school_filter" id="school_filter">
                        <option value="0">All Schools</option>
                        <?php foreach ($schools as $school) : ?>
                            <option value="<?= $school->id; ?>"><?= $school->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3 text-center">
                    <input type="submit" class="btn btn-primary" value="View Members">
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Display Members by School -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="text-center">Members</h3>
            <div class="p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">School</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member) : ?>
                            <tr>
                                <th scope="row"><?= $member->id; ?></th>
                                <td><?= $member->name; ?></td>
                                <td><?= $member->email; ?></td>
                                <td>
                                    <?php
                                    // Fetch the school name for this member using their school_id
                                    $schoolName = '';
                                    foreach ($schools as $school) {
                                        if ($school->id == $member->school_id) {
                                            $schoolName = $school->name;
                                            break;
                                        }
                                    }
                                    echo $schoolName;
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    



        