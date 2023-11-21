<?php
$host = 'localhost:8889';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$urlrequest = $_SERVER['REQUEST_URI'];
$query = parse_url($urlrequest, PHP_URL_QUERY);
parse_str($query, $param);

$context = $param['context'];

if ($context == "cities") {
    $query = "SELECT * FROM countries
              JOIN cities ON countries.code = cities.country_code
              WHERE countries.name LIKE '%$country%'";
    $result = $conn->query($query);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    echo '<table>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>';

    foreach ($rows as $row) {
        echo '<tr>
                <td>' . $row['name'] . '</td>
                <td>' . $row['district'] . '</td>
                <td>' . $row['population'] . '</td>
              </tr>';
    }

    echo '</table>';
} else {
    $query = "SELECT * FROM countries
              WHERE name LIKE '%$country%'";
    $result = $conn->query($query);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    echo '<table>
            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Year of Independence</th>
                <th>Head of State</th>
            </tr>';

    foreach ($rows as $row) {
        echo '<tr>
                <td>' . $row['name'] . '</td>
                <td>' . $row['continent'] . '</td>
                <td>' . $row['independence_year'] . '</td>
                <td>' . $row['head_of_state'] . '</td>
              </tr>';
    }

    echo '</table>';
}
?>
