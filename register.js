const inputUsername = document.querySelector("#username");

inputUsername.addEventListener("change", async function (e) {
  // 1. preparation
  const username = inputUsername.value;
  // 2. sending
  const response = await fetch(`ajax_username_exists.php?username=${username}`, {
    method: "GET"
  });
  const exists = await response.json();
  // console.log(exists);
  // 3. process the response 0,1
  const span = document.querySelector("#username + span");
  inputUsername.classList.toggle("error", exists === 1);
  inputUsername.classList.toggle("success", exists === 0);
  span.innerHTML = exists === 0 ? "✅" : "X";
});