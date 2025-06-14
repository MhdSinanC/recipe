/*=========================================================================================
    File Name: line.js
    Description: D3 simple line chart
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

// Line chart
// ------------------------------
$(window).on("load", function(){

    var dispatch = d3.dispatch("load", "statechange"),
    ele = d3.select("#disptach-events");

    var groups = [
        "Under 5 Years",
        "5 to 13 Years",
        "14 to 17 Years",
        "18 to 24 Years",
        "25 to 44 Years",
        "45 to 64 Years",
        "65 Years and Over"
    ];

    d3.csv("../../../app-assets/data/d3/pie/dispatch-events.csv", type, function(error, states) {
        if (error) throw error;
        var stateById = d3.map();
        states.forEach(function(d) {
            stateById.set(d.id, d);
        });
        dispatch.load(stateById);
        dispatch.statechange(stateById.get("CA"));
    });

    // A drop-down menu for selecting a state; uses the "menu" namespace.
    dispatch.on("load.menu", function(stateById) {
        var select = ele
            .append("div")
            .append("select")
            .on("change", function() {
                dispatch.statechange(stateById.get(this.value));
            });

        select.selectAll("option")
            .data(stateById.values())
            .enter().append("option")
            .attr("value", function(d) {
                return d.id;
            })
            .text(function(d) {
                return d.id;
            });

        dispatch.on("statechange.menu", function(state) {
            select.property("value", state.id);
        });
    });

    // A bar chart to show total population; uses the "bar" namespace.
    dispatch.on("load.bar", function(stateById) {
        var margin = {
                top: 20,
                right: 20,
                bottom: 30,
                left: 40
            },
            width = 80 - margin.left - margin.right,
            height = 460 - margin.top - margin.bottom;

        var y = d3.scale.linear()
            .domain([0, d3.max(stateById.values(), function(d) {
                return d.total;
            })])
            .rangeRound([height, 0])
            .nice();

        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .tickFormat(d3.format(".2s"));

        var svg = ele.append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);

        var rect = svg.append("rect")
            .attr("x", 4)
            .attr("width", width - 4)
            .attr("y", height)
            .attr("height", 0)
            .style("fill", "#aaa");

        dispatch.on("statechange.bar", function(d) {
            rect.transition()
                .attr("y", y(d.total))
                .attr("height", y(0) - y(d.total));
        });
    });

    // A pie chart to show population by age group; uses the "pie" namespace.
    dispatch.on("load.pie", function(stateById) {
        var width = ele.node().getBoundingClientRect().width - 100,
            height = 460,
            radius = Math.min(width, height) / 2;

        var color = d3.scale.ordinal()
            .domain(groups)
            .range(["#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#F8B195", "#F67280", "#C06C84"]);

        var arc = d3.svg.arc()
            .outerRadius(radius - 10)
            .innerRadius(radius - 70);

        var pie = d3.layout.pie()
            .sort(null);

        var svg = ele.append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

        var path = svg.selectAll("path")
            .data(groups)
            .enter().append("path")
            .style("fill", color)
            .each(function() {
                this._current = {
                    startAngle: 0,
                    endAngle: 0
                };
            });

        dispatch.on("statechange.pie", function(d) {
            path.data(pie.value(function(g) {
                    return d[g];
                })(groups)).transition()
                .attrTween("d", function(d) {
                    var interpolate = d3.interpolate(this._current, d);
                    this._current = interpolate(0);
                    return function(t) {
                        return arc(interpolate(t));
                    };
                });
        });
    });

    // Coerce population counts to numbers and compute total per state.
    function type(d) {
        d.total = d3.sum(groups, function(k) {
            return d[k] = +d[k];
        });
        return d;
    }
});