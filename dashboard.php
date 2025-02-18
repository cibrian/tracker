<?php
require 'vendor/autoload.php';
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center bg-light">
    <div id="app" class="mt-5">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid d-flex justify-content-end">
                <a href="/logout.php" class="btn btn-danger">Logout</a>
            </div>
        </nav>
        <h1 class="text-center mb-4">VISITS</h1>

        <div class="d-flex gap-2 flex-wrap mb-3">
            <input type="date" v-model="date" class="form-control w-auto">
            <button @click="fetchVisits" class="btn btn-primary">Fetch Visits</button>
        </div>

        <div class="table-responsive" v-if="!loading && !error && visits.length > 0">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">URL</th>
                        <th scope="col">TOTAL VISITS</th>
                        <th scope="col">DATE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="visit in visits" :key="visit.url">
                        <td>{{ visit.url }}</td>
                        <td>{{ visit.total }}</td>
                        <td>{{ date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h2 v-if="!loading && !error && visits.length === 0" class="text-center text-muted mt-4">
            NO RECORDS FOUND
        </h2>
    </div>
    <script>
        new Vue({
            el: "#app",
            data: {
                visits: [],
                loading: false,
                error: null,
                limit: 5,
                date: '2025-02-17'
            },
            methods: {
                fetchVisits() {
                    this.loading = true;
                    this.error = null;

                    fetch(`getVisits.php?date=${this.date}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error("Failed to fetch data");
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data);
                            this.visits = data;
                        })
                        .catch(err => {
                            this.error = err.message;
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            },
            created() {
                this.fetchVisits();
            }
        });
    </script>
</body>
</html>