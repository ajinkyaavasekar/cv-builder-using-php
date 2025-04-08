<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A form to create a professional CV">
    <meta name="author" content="">
    <title>Create Your Professional CV</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .card {
            border: none; /* Optional: remove default card border if using shadow */
        }
        .form-label {
            font-weight: 500;
        }
        /* Add some extra spacing below form text */
        .form-text {
            margin-bottom: 0.5rem;
        }
        textarea {
             white-space: pre-wrap; /* Ensure whitespace is respected in textareas */
        }
    </style>

    <meta name="theme-color" content="#712cf9">
</head>
<body>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8"> 
                <div class="card shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <h1 class="card-title text-center mb-4">Craft Your Professional CV</h1>
                        <p class="text-muted text-center mb-5">Fill out the form below to generate a well-formatted CV.</p>
                        <form action="cv.php" method="POST" enctype="multipart/form-data">

                            <h4 class="mb-3 border-bottom pb-2">Personal Information</h4>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="nameInput" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    
                                    <input type="text" name="name" id="nameInput" class="form-control" placeholder="e.g., Jane Doe" required>
                                    <div class="form-text">As it should appear on the CV.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="jobTitleInput" class="form-label">Current Job Title / Headline</label>
                                    <input type="text" name="job_title" id="jobTitleInput" class="form-control" placeholder="e.g., Software Engineer | Marketing Manager">
                                    <div class="form-text">Optional: A brief professional headline.</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="addressInput" class="form-label">Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" id="addressInput" class="form-control" placeholder="e.g., 123 Main St, Anytown, CA 90210" required>
                                <div class="form-text">Your current residential address.</div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="phoneInput" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" id="phoneInput" class="form-control" placeholder="e.g., +1 555-123-4567" required>
                                    <div class="form-text">Include country code if applicable.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="emailInput" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="emailInput" class="form-control" placeholder="e.g., jane.doe@example.com" required>
                                    <div class="form-text">Use a professional email address.</div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <label for="dateInput" class="form-label">Date of Birth</label>
                                    <input type="text" name="date" id="dateInput" class="form-control" placeholder="e.g., YYYY-MM-DD or January 1, 1990">
                                    <div class="form-text">Optional. Consider privacy implications.</div>
                                </div>
                                <div class="col-sm-6">
                                     <label for="picInput" class="form-label">Profile Picture</label>
                                     <input type="file" name="pic" id="picInput" class="form-control" accept="image/jpeg, image/png">
                                     <div id="picHelp" class="form-text">Optional: Professional headshot (JPG, PNG). Max 2MB.</div>
                                </div>
                            </div>


                            <h4 class="mb-3 mt-5 border-bottom pb-2">Professional Summary</h4>

                            <div class="mb-4">
                                <label for="descriptionInput" class="form-label">Profile / About Me</label>
                                <textarea name="description" id="descriptionInput" rows="4" class="form-control md-textarea" placeholder="Write a brief (2-4 sentences) and compelling summary highlighting your key skills, experience level, and career objective. Tailor this to the jobs you are applying for."></textarea>
                                <div class="form-text">Your professional elevator pitch.</div>
                            </div>

                             <h4 class="mb-3 mt-5 border-bottom pb-2">Work Experience</h4>

                            <div class="mb-4">
                                <label for="experienceInput" class="form-label">Experience Details</label>
                                <textarea name="experience" id="experienceInput" rows="8" class="form-control md-textarea" placeholder="List jobs in reverse chronological order (most recent first).&#10;Example:&#10;--------------------&#10;Senior Developer | Tech Solutions Inc. | Anytown, USA | Jan 2020 - Present&#10;- Led a team of 5 developers in creating a new SaaS platform.&#10;- Implemented features resulting in a 15% increase in user engagement.&#10;- Optimized database queries, reducing load time by 30%.&#10;&#10;Junior Developer | Web Widgets LLC | Sometown, USA | Jun 2018 - Dec 2019&#10;- Developed front-end components using React.&#10;- Collaborated with designers to implement UI mockups.&#10;--------------------&#10;Use bullet points starting with '-' or '*' for responsibilities/achievements."></textarea>
                                <div class="form-text">Focus on quantifiable achievements. Use clear formatting as shown in the placeholder.</div>
                            </div>

                             <h4 class="mb-3 mt-5 border-bottom pb-2">Education & Certifications</h4>

                            <div class="mb-4">
                                <label for="educationInput" class="form-label">Education Details</label>
                                
                                <textarea name="education" id="educationInput" rows="6" class="form-control md-textarea" placeholder="List degrees/certifications in reverse chronological order.&#10;Example:&#10;--------------------&#10;M.S. in Computer Science | University of Example | Anytown, USA | 2016 - 2018&#10;- Thesis: [Your Thesis Title]&#10;- Relevant Coursework: Advanced Algorithms, Machine Learning&#10;&#10;B.S. in Software Engineering | State College | Sometown, USA | 2012 - 2016&#10;- Graduated Cum Laude&#10;&#10;Certified Scrum Master | Scrum Alliance | 2021&#10;--------------------"></textarea>
                                <div class="form-text">Include institution, degree/certification name, location, and dates.</div>
                            </div>

                            <h4 class="mb-3 mt-5 border-bottom pb-2">Skills & Links</h4>

                             <div class="mb-3">
                                <label for="skillsInput" class="form-label">Skills</label>
                                <textarea name="skills" id="skillsInput" rows="3" class="form-control md-textarea" placeholder="List relevant technical and soft skills.&#10;Example:&#10;--------------------&#10;Programming Languages: Java, Python, JavaScript, PHP&#10;Frameworks: Spring Boot, Django, React, Node.js&#10;Databases: MySQL, PostgreSQL, MongoDB&#10;Tools: Git, Docker, Jenkins, AWS&#10;Languages: English (Native), Spanish (Conversational)&#10;Soft Skills: Team Leadership, Agile Methodologies, Problem Solving&#10;--------------------&#10;Categorize skills if helpful."></textarea>
                                <div class="form-text">Separate skills or categories clearly (e.g., use new lines or commas).</div>
                            </div>

                             <div class="mb-4">
                                <label for="linksInput" class="form-label">Professional Links</label>
                                <textarea name="links" id="linksInput" rows="3" class="form-control md-textarea" placeholder="Provide links to your LinkedIn profile, portfolio, GitHub, etc.&#10;Example:&#10;--------------------&#10;LinkedIn: https://linkedin.com/in/yourprofile&#10;Portfolio: https://yourportfolio.com&#10;GitHub: https://github.com/yourusername&#10;--------------------&#10;Enter one link per line with a label."></textarea>
                                <div class="form-text">Include full URLs (https://...).</div>
                            </div>


                            <div class="text-center mt-5">
                                <button name="submit" class="btn btn-primary btn-lg px-5" type="submit">Generate Professional CV</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>