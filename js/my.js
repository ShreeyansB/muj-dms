function calcGPA(num, credits) {
  var x;
  var i;
  var j;
  var grade_points = [];

  function convGrade(grade) {
    switch (grade) {
      case 'a+':
        return 10;
      case 'a':
        return 9;
      case 'b':
        return 8;
      case 'c':
        return 7;
      case 'd':
        return 6;
      case 'e':
        return 5;
      case 'f':
        return 0;
      default:
        return -1;
    }
  }

  for (i = 0; i < num; i++) {
    x = document.getElementsByName("radioToggleButton" + (i + 1));
    for (j = 0; j < 7; j++) {
      if (x[j].checked) {
        grade_points.push(convGrade(x[j].value));
      }
    }
  }

  var numerator = 0;
  var denominator = 0;

  for (i = 0; i < num; i++) {
    numerator += credits[i] * grade_points[i];
    denominator += credits[i];
  }

  var gpa = numerator / denominator;
  gpa = gpa.toFixed(2);

  if (document.getElementById('gpa-text') != null) {
    console.log('poo');
    animateCSS('gpa-container', 'flipInX');
    document.getElementById('gpa-text').innerHTML = gpa;
  } else {
    var node = document.createElement("DIV");
    node.classList.add('row', 'mt-0');
    node.id = "gpa-container";
    var span = document.createElement("SPAN");
    span.classList.add('ps-0');
    span.innerHTML = '<text class="fs-3" style="font-weight:600 !important;">Expected GPA: </text><text class="font-monospace fw-bold fs-3" id="gpa-text">' + gpa + '</text>';
    node.appendChild(span);
    document.getElementById("calc-gpa-container").appendChild(node);
    animateCSS('gpa-container', 'flipInX');
  }
};

const animateCSS = (element, animation, prefix = 'animate__') =>
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.getElementById(element);
    node.classList.add(`${prefix}animated`, animationName);

    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove(`${prefix}animated`, animationName);
      resolve('Animation ended');
    }

    node.addEventListener('animationend', handleAnimationEnd, {
      once: true
    });
  });