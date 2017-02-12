app.filter('range', function () {
    return function (input, count, current) {
       // console.log(count + "----CC-------" + current);
        count = parseInt(count);
        current = parseInt(current);        
        var begin = 0;
        var end = 0;
        if (count <= 5) {
            begin = 1;
            end = count;
        } else {
            begin = current - 2;
            end = current + 2;
            if (begin < 1) {
                begin = 1;
                end = 5;
            }
        }

      //  console.log(begin + "-----------" + end);
        for (var i = begin; i <= end; i++) {
            input.push(i);
        }

        return input;
    };
});