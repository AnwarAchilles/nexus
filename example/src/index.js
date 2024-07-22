document.addEventListener("DOMContentLoaded", function() {
  var loadTimeMs = performance.now(); // Get load time in milliseconds
  var loadTimeSeconds = loadTimeMs / 1000; // Convert to seconds

  // Display time with 4 digits precision
  var loadTimeDisplay = loadTimeSeconds.toFixed(4) + "s";

  document.getElementById("speed-result").innerText = "Frontend load time: " + loadTimeDisplay;
});
