@extends('layouts.app')

@section('title', 'Search Nearby Fuel Stations')

@section('content')
    <section class="search-section">
        <h2>Search Nearby Fuel Stations</h2>
        <button id="search-button">Find Nearby Stations</button>

        <div id="map" style="height: 400px; margin-top: 20px;"></div> <!-- Map Section -->

        <div id="results" style="margin-top: 20px;">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Distance (km)</th>
                    </tr>
                </thead>
                <tbody id="results-body">
                    <!-- Results will be dynamically inserted here -->
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div id="pagination-links" style="margin-top: 20px;"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchButton = document.getElementById('search-button');
            const resultsBody = document.getElementById('results-body');
            const map = L.map('map').setView([22.7196, 75.8577], 13); // Default view centered on Indore

            // Add the OSM tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let userMarker;
            let stationMarkers = [];
            let currentPage = 1;

            // Function to fetch and display stations and handle pagination
            function loadStations(page = 1) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        // Update map to user's location
                        if (userMarker) {
                            userMarker.setLatLng([latitude, longitude]);
                        } else {
                            userMarker = L.marker([latitude, longitude], { icon: L.icon({
                                iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
                                iconSize: [38, 38],
                            })}).addTo(map)
                                .bindPopup('You are here!')
                                .openPopup();
                        }
                        map.setView([latitude, longitude], 13);

                        // Fetch nearby fuel stations with pagination
                        fetch(`/api/nearby-fuel-stations?latitude=${latitude}&longitude=${longitude}&page=${page}`)
                            .then((response) => response.json())
                            .then((data) => {
                                resultsBody.innerHTML = ''; // Clear previous results
                                stationMarkers.forEach(marker => map.removeLayer(marker)); // Clear previous markers
                                stationMarkers = [];

                                if (data.stations.length === 0) {
                                    resultsBody.innerHTML = `<tr><td colspan="3">No nearby fuel stations found</td></tr>`;
                                    return;
                                }

                                data.stations.forEach((station) => {
                                    const row = `<tr>
                                        <td>${station.name}</td>
                                        <td>${station.address}</td>
                                        <td>${station.distance.toFixed(2)}</td>
                                    </tr>`;
                                    resultsBody.innerHTML += row;

                                    // Add station marker to map
                                    const stationMarker = L.marker([station.latitude, station.longitude])
                                        .addTo(map)
                                        .bindPopup(`<b>${station.name}</b><br>${station.address}<br>${station.distance.toFixed(2)} km`);
                                    stationMarkers.push(stationMarker);
                                });

                                // Add pagination links
                                const paginationLinks = data.pagination;
                                let paginationHtml = '';
                                if (paginationLinks.previous_page) {
                                    paginationHtml += `<a href="#" class="pagination-link" data-page="${paginationLinks.previous_page}">Previous</a> `;
                                }
                                if (paginationLinks.next_page) {
                                    paginationHtml += `<a href="#" class="pagination-link" data-page="${paginationLinks.next_page}">Next</a>`;
                                }
                                document.getElementById('pagination-links').innerHTML = paginationHtml;
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    });
                } else {
                    alert('Geolocation is not supported by your browser.');
                }
            }

            // Initial load
            loadStations(currentPage);

            // Event listener for pagination links
            document.getElementById('pagination-links').addEventListener('click', (e) => {
                if (e.target.classList.contains('pagination-link')) {
                    const page = e.target.dataset.page;
                    currentPage = parseInt(page);
                    loadStations(currentPage);
                }
            });

            // Search button click handler
            searchButton.addEventListener('click', () => {
                loadStations(currentPage);
            });
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        header {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f4f4f4;
        }

        #search-button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        #search-button:hover {
            background: #0056b3;
        }

        #results {
            margin-top: 20px;
        }

        #results table {
            border: 1px solid #ccc;
        }

        #results th, #results td {
            text-align: left;
        }

        #map {
            width: 100%;
            border: 1px solid #ccc;
            margin-top: 20px;
        }

        .pagination-link {
            margin-right: 5px;
            cursor: pointer;
            color: #007bff;
        }

        .pagination-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection
