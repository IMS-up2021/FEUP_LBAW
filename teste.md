# PA: Product and Presentation

> BrainShare seeks to use the internet’s power to connect people towards developing knowledge collaboratively.


## A9: Product

> Brief presentation of the product developed.  

### 1. Installation

> The link to the release containing the final version of the source code is available in the group's Git repository, [here.](https://git.fe.up.pt/lbaw/lbaw2324/lbaw23136)

> The full Docker command to launch the image available at the group's GitLab Container Registry using the production database is:

```
docker run -it -p 8000:80 --name=lbaw23136 -e DB_DATABASE="lbaw23136" -e DB_SCHEMA="lbaw23136 -e DB_USERNAME="lbaw23136" -e DB_PASSWORD="PHMjYOOt" git.fe.up.pt:5050/lbaw/lbaw2324/lbaw23136 
```

### 2. Usage

> To access the product, you can use the following URL: http://lbaw23136.lbaw.fe.up.pt.

#### 2.1. Administration Credentials

> Administration URL: https://lbaw23136.lbaw.fe.up.pt/administration/ 

|   Email            | Password |
| --------           | -------- |
| admin@gmail.com    | 1234     |

#### 2.1. Moderation Credentials

> Moderation URL: https://lbaw23136.lbaw.fe.up.pt/administration/ 

|   Email            | Password |
| --------           | -------- |
| moderator@gmail.com| 1234     |

#### 2.2. User Credentials

|   Email            | Password |
| --------           | -------- |
| user1@gmail.com    | 1234     |
| user2@gmail.com    | 1234     |

### 3. Application Help

> The Help-related features have been integrated alongside the other main functionalities. They are manifested through the implementation of "403 pages" when an action lacks authorization, as well as through error/success messages that accompany specific actions. Additionally, these features are also incorporated into static pages such as  "FAQ", "About us" and "Contacts". Here are some examples:

> FAQ page
![faq](uploads/6e3f23e6bde12564a366daaeb197600f/image.png)

> About us page
![about](uploads/b4c85bca29444cfd6f2e6998d3869b7d/image.png)

> Contacts page
![contacts](uploads/8873e0cfe18a1add0835072d9787fd07/image.png)

> Login error message
![login_error](uploads/b258dae728565f536074db0b78fd040f/login_error.png)

> Delete user success message
![delete_success](uploads/4958461ac4b17883ebe0faa43b8946eb/image.png)

> 403 page
![403_page](uploads/28acbf8d75583bfdd4aef70648445968/image.png)



### 4. Input Validation

> For the back-end input validation, we used the versatile "validate" function from the Illuminate\Http\Request. This function was systematically applied across various controller functions in our project, covering a range of validation types (excluding the GET method).
- Edit profile example:
![edit_profile](uploads/ea1aac44fc4bbe09458b5a147f36f6c8/image.png)
![edit_profile_code](uploads/1658b2cb2b67b0eb1455ec67b103755a/image.png)

> On the other side, the client-side validation is designed to enhance the user experience. Therefore ,for example, when editing a comment, if a user attempts to submit an empty comment, a warning is triggered.

![empty_comment](uploads/a2d0168c25d41c12decf4c42b55ac079/image.png)

### 5. Check Accessibility and Usability

> Provide the results of accessibility and usability tests using the following checklists. Include the results as PDF files in the group's repository. Add individual links to those files here.
>
> Accessibility: https://ux.sapo.pt/checklists/acessibilidade/  
> Usability: https://ux.sapo.pt/checklists/usabilidade/  

### 6. HTML & CSS Validation

> Provide the results of the validation of the HTML and CSS code using the following tools. Include the results as PDF files in the group's repository. Add individual links to those files here.
>   
> HTML: https://validator.w3.org/nu/  
> CSS: https://jigsaw.w3.org/css-validator/  

### 7. Revisions to the Project

> Describe the revisions made to the project since the requirements specification stage.  


### 8. Web Resources Specification

> Updated OpenAPI specification in YAML format to describe the final product's web resources.

> Link to the `a9_openapi.yaml` file in the group's repository.


```yaml
openapi: 3.0.0

...
```

### 9. Implementation Details

#### 9.1. Libraries Used

> Include reference to all the libraries and frameworks used in the product.  
> Include library name and reference, description of the use, and link to the example where it's used in the product.  

#### 9.2 User Stories

> This subsection should include all high and medium priority user stories, sorted by order of implementation. Implementation should be sequential according to the order identified below. 
>
> If there are new user stories, also include them in this table. 
> The owner of the user story should have the name in **bold**.
> This table should be updated when a user story is completed and another one started. 

| US Identifier | Name    | Module | Priority                       | Team Members               | State  |
| ------------- | ------- | ------ | ------------------------------ | -------------------------- | ------ |
|  US01          | US Name 1 | Module A | High | **John Silva**, Ana Alice   |  100%  |
|  US02          | US Name 2 | Module A | Medium | **Ana Alice**, John Silva                 |   75%  | 
|  US03          | US Name 3 | Module B | Low | **Francisco Alves**                 |   5%  | 
|  US04          | US Name 4 | Module A | Low | -                 |   0%  | 


---


## A10: Presentation
 
> This artifact corresponds to the presentation of the product.

### 1. Product presentation

> Brief presentation of the product and its main features (2 paragraphs max).  
>
> URL to the product: http://lbawYYgg.lbaw.fe.up.pt  
>
> Slides used during the presentation should be added, as a PDF file, to the group's repository and linked to here.


### 2. Video presentation

> Screenshot of the video plus the link to the lbawYYgg.mp4 file.

> - Upload the lbawYYgg.mp4 file to Moodle.
> - The video must not exceed 2 minutes.


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUPYYgg, DD/MM/20YY

* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...