/**
 * Progress bar animation by Hakan Havutcuoglu
 * https://codepen.io/havutcuoglu/pen/abMdvoq
 * This notice MUST stay intact in JS files and SCRIPT tags for free and legal usege.
 */

$(document).ready(function(){
    progress_bar();
});

function progress_bar() {
    var speed = 30;
    var items = $('.progress_bar').find('.progress_bar_item');

    items.each(function() {
        var item = $(this).find('.progress');
        var itemValue = item.data('progress');
        var i = 0;
        var value = $(this);

        var count = setInterval(function(){
            if(i <= itemValue) {
                var iStr = i.toString();
                item.css({
                    'width': iStr+'%'
                });
                value.find('.item_value').html(iStr +'%');
            }
            else {
                clearInterval(count);
            }
            i++;
        },speed);
    });
}

$(document).ready(function() {
    // Ensure the canvas context is correctly referenced
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["M", "T", "W", "T", "F", "S", "S"],
            datasets: [{
                label: 'apples',
                data: [12, 19, 3, 17, 28, 24, 7],
                backgroundColor: "rgba(153,255,51,1)"
            }, {
                label: 'oranges',
                data: [30, 29, 5, 5, 20, 3, 10],
                backgroundColor: "rgba(255,153,0,1)"
            }]
        }
    });
});
