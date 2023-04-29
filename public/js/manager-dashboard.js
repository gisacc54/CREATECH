$(document).ready(function () {
    getDashboardStatisticalData()
})

function getDashboardStatisticalData() {
    var totalUsersCard = $('#total-staffs')
    var totalRegionsCard = $('#total-regions')
    var totalDistrictsCard = $('#total-districts')
    var totalWardsCard = $('#total-wards')
    var totalStreetsCard = $('#total-streets')
    $.get('/manager/ajax/get/dashboard/statistical/data',function (response) {
        totalUsersCard.html(response.total_users)
        totalRegionsCard.html(response.total_regions)
        totalDistrictsCard.html(response.total_districts)
        totalWardsCard.html(response.total_wards)
        totalStreetsCard.html(response.total_streets)
    });
}
