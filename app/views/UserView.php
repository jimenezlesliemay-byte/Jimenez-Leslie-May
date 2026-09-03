<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding: 50px;

            /* Blue / Purple background inspired by your image */
            background:
                radial-gradient(circle at 20% 20%, #00e5ff 0%, transparent 25%),
                radial-gradient(circle at 80% 30%, #542cff 0%, transparent 30%),
                radial-gradient(circle at 50% 80%, #001eff 0%, transparent 35%),
                linear-gradient(135deg, #02005c, #0800b8, #2411d8, #00bfff);
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: auto;
            padding: 35px;

            background: rgba(5, 5, 80, 0.80);
            border: 2px solid #00eaff;
            border-radius: 20px;

            box-shadow:
                0 0 15px #00eaff,
                0 0 35px rgba(0, 238, 255, 0.5);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;

            color: #ffffff;
            font-size: 38px;
            letter-spacing: 2px;

            text-shadow:
                0 0 10px #00eaff,
                0 0 20px #5b2cff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 12px;

            background: rgba(0, 0, 80, 0.75);
        }

        thead {
            background: linear-gradient(
                90deg,
                #0800b8,
                #4b19e6,
                #00cfff
            );
        }

        th {
            padding: 16px;
            color: white;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;

            border-bottom: 2px solid #00eaff;
        }

        td {
            padding: 15px;
            color: #ffffff;
            text-align: center;

            border-bottom: 1px solid rgba(0, 234, 255, 0.35);
        }

        tbody tr {
            transition: 0.3s;
        }

        tbody tr:nth-child(even) {
            background: rgba(67, 30, 190, 0.35);
        }

        tbody tr:nth-child(odd) {
            background: rgba(0, 50, 180, 0.35);
        }

        tbody tr:hover {
            background: rgba(0, 220, 255, 0.25);

            box-shadow:
                inset 0 0 15px rgba(0, 238, 255, 0.5);

            transform: scale(1.01);
        }

        .id {
            color: #00eaff;
            font-weight: bold;
        }

        .username {
            color: #bca7ff;
            font-weight: bold;
        }

        .email {
            color: #7eeaff;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .container {
                width: 100%;
                padding: 20px;
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Users List</h1>

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($users as $user): ?>

                    <tr>
                        <td class="id">
                            <?= $user['id']; ?>
                        </td>

                        <td>
                            <?= $user['firstname']; ?>
                        </td>

                        <td>
                            <?= $user['lastname']; ?>
                        </td>

                        <td class="email">
                            <?= $user['email']; ?>
                        </td>

                        <td class="username">
                            <?= $user['username']; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>
</html>