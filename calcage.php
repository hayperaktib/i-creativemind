<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Validation</title>
</head>
<body>

  <h2>Select Validation Example</h2>

  <form onsubmit="return validateSelect()">
    <label for="fruit">Choose a fruit:</label>
    <select id="fruit">
      <option value="">-- Select a fruit --</option> <!-- Default invalid -->
      <option value="apple">Apple</option>
      <option value="banana">Banana</option>
      <option value="orange">Orange</option>
    </select>

    <br><br>
    <button type="submit">Submit</button>
  </form>

  <p id="errorMsg" style="color:red;"></p>

  <script>
    function validateSelect() {
      const selectElement = document.getElementById("fruit");
      const selectedValue = selectElement.value;
      const errorMsg = document.getElementById("errorMsg");

      if (selectedValue === "") {
        errorMsg.textContent = "Please select a fruit before submitting.";
        return false; // Prevent form submission
      } else {
        errorMsg.textContent = ""; // Clear any previous error
        alert("You selected: " + selectedValue);
        return true; // Allow form submission
      }
    }
  </script>

</body>
</html>