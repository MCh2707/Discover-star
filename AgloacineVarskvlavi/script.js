function myMenuFunction() {
    const navMenu = document.getElementById("navMenu");
    navMenu.classList.toggle("active");
}

function login() {
    const x = document.getElementById("login");
    const y = document.getElementById("register");
    const a = document.getElementById("loginBtn");
    const b = document.getElementById("registerBtn");
    
    x.style.left = "4px";
    y.style.right = "520px";
    a.classList.add("white-btn");
    b.classList.remove("white-btn");
    x.style.opacity = 1;
    y.style.opacity = 0;
}

function register() {
    const x = document.getElementById("login");
    const y = document.getElementById("register");
    const a = document.getElementById("loginBtn");
    const b = document.getElementById("registerBtn");
    
    x.style.left = "-510px";
    y.style.right = "5px";
    a.classList.remove("white-btn");
    b.classList.add("white-btn");
    x.style.opacity = 0;
    y.style.opacity = 1;
}

function handleRegister() {
    const firstNameField = document.getElementById("register-firstname");
    const lastNameField = document.getElementById("register-lastname");
    const classField = document.getElementById("register-class"); // Class field
    const teacherField = document.getElementById("register-teacher"); // Teacher's name field
    const emailField = document.getElementById("register-email");
    const passwordField = document.getElementById("register-password");

    const firstName = firstNameField.value;
    const lastName = lastNameField.value;
    const userClass = parseInt(classField.value); // Convert class to a number
    const teacher = teacherField.value;
    const email = emailField.value;
    const password = passwordField.value;

    // Validate if the class is 7 or above
    if (userClass < 7) {
        alert('📚 მონაწილეობა შესაძლებელია მხოლოდ მე-7 კლასის და ზემოთ!');
        return; // Stop registration
    }

    if (firstName && lastName && email && password) {
        // Store user details in localStorage
        const user = {
            firstName: firstName,
            lastName: lastName,
            userClass: userClass, // Save the class
            teacher: teacher, // Save the teacher's name
            email: email,
            password: password
        };

        // Save to localStorage (use email as key)
        localStorage.setItem(email, JSON.stringify(user));

        alert('რეგისტრაცია წარმატებით დასრულდა. გთხოვთ შეხვიდეთ სისტემაში.');
        login(); // Switch to login form
    } else {
        alert('გთხოვთ შეავსოთ ყველა ველი.');
    }
}

function handleLogin() {
    const usernameField = document.getElementById("login-username");
    const passwordField = document.getElementById("login-password");

    const username = usernameField.value;
    const password = passwordField.value;

    // Attempt to find the user by email in localStorage
    const storedUser = JSON.parse(localStorage.getItem(username));

    if (storedUser && storedUser.password === password) {
        // Redirect to the welcome page upon successful login
        window.location.href = 'welcome.html'; // Change this to your actual page
    } else {
        alert('არასწორი ელფოსტა ან პაროლი. გთხოვთ, სცადოთ ხელახლა.');
    }
}

// რეგისტრაციის ფორმის დასაწყისი
document.getElementById("register").addEventListener("submit", function(event) {
    event.preventDefault(); // აცილებს ფორმის სერვერზე გაგზავნას

    const firstname = document.querySelector('input[name="firstname"]').value;
    const lastname = document.querySelector('input[name="lastname"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const password = document.querySelector('input[name="password"]').value;
    const classInput = document.querySelector('input[name="class"]').value;
    const teacherName = document.querySelector('input[name="teacherName"]').value;


    localStorage.setItem("firstname", firstname);
    localStorage.setItem("lastname", lastname);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);
    localStorage.setItem("class", classInput);
    localStorage.setItem("teacherName", teacherName);

    alert("Registration successful!");
});
