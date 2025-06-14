/*=========================================================================================
    File Name: bivariate.js
    Description: d3 bivariate area chart
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

// Bivariate area chart
// ------------------------------
$(window).on("load", function(){

    var ele = d3.select("#bivariate-chart"),
    margin = {top: 20, right: 20, bottom: 30, left: 50},
    width = ele.node().getBoundingClientRect().width - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

    var parseDate = d3.time.format("%Y%m%d").parse;


    // Scales
    // ------------------------------

    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    // Axis
    // ------------------------------
    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

    // Chart
    var area = d3.svg.area()
        .x(function(d) { return x(d.date); })
        .y0(function(d) { return y(d.low); })
        .y1(function(d) { return y(d.high); });

    var container = ele.append("svg");

    var svg = container
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
      .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



    // Load data
    // ------------------------------

    d3.tsv("../../../app-assets/data/d3/line/bivariate-area.tsv", function(error, data) {
        if (error) throw error;

        data.forEach(function(d) {
            d.date = parseDate(d.date);
            d.low = +d.low;
            d.high = +d.high;
        });

        x.domain(d3.extent(data, function(d) { return d.date; }));
        y.domain([d3.min(data, function(d) { return d.low; }), d3.max(data, function(d) { return d.high; })]);

        svg.append("path")
            .datum(data)
            .attr("class", "d3-area")
            .attr("d", area)
            .style("fill", "#FF5722");

        svg.append("g")
            .attr("class", "d3-axis d3-xaxis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        svg.append("g")
            .attr("class", "d3-axis d3-yaxis")
            .call(yAxis)
        .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .style("fill", "#FF5722")
            .style("font-size", 12)
            .text("Price ($)");
    });

    // Resize chart
    // ------------------------------

    // Call function on window resize
    $(window).on('resize', resize);

    // Call function on sidebar width change
    $('.menu-toggle').on('click', resize);

    // Resize function
    // ------------------------------
    function resize() {

        width = ele.node().getBoundingClientRect().width - margin.left - margin.right;

        // Main svg width
        container.attr("width", width + margin.left + margin.right);

        // Width of appended group
        svg.attr("width", width + margin.left + margin.right);


        // Axis
        // -------------------------
        x.range([0, width]);
        svg.selectAll('.d3-xaxis').call(xAxis);


        svg.selectAll('.d3-area').attr("d", area);
    }
});