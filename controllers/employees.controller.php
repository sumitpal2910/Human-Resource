<?php

class EmployeesController
{
    /*===================================
        LOGIN EMPLOYEE
    ===================================== */
    static public function ctlrLoginEmployee()
    {
        if (isset($_POST['empLoginBtn'])) {
            $email = $_POST['empLoginEmail'];
            $password = $_POST['empLoginPassword'];

            $table = "employees";
            $item = "email";
            $value = $email;
            $result = ModelEmployees::mdlShowEmployees($table, $item, $value);

            if ($result['email'] === $email && password_verify($password, $result['password'])) {
                if ($result['status'] == 1) {

                    $_SESSION['loginSession'] = "ok";
                    $_SESSION['role'] = "employee";
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['empId'] = $result['id'];
                    $_SESSION['image'] = $result['image'];

                    echo "<script>
                            window.location = 'home';
                    </script>";
                } else {
                    echo "<br><div class='alert alert-danger'>Your Account is Deactivated</div>";
                }
            } else {
                echo "<br><div class='alert alert-danger'>Email Password not match</div>";
            }
        }
    }


    /*===================================
        SHOW EMPLOYEES
    ===================================== */
    static public function ctlrShowEmployees($item, $value)
    {
        $table = "employees";
        $result = ModelEmployees::mdlShowEmployees($table, $item, $value);
        return $result;
    }


    /*=============================================
        CREATE EMPLOYEE
    ================================================= */
    static public function ctlrCreateEmployee()
    {
        if (isset($_POST['createEmployee'])) {
            $code = $_POST['newEmpCode'];
            $name = $_POST['newEmpName'];
            $fatherName = $_POST['newEmpFatherName'];
            $dateOfBirth = $_POST['newEmpDoB'];
            $gender = $_POST['newEmpGender'];
            $phone = $_POST['newEmpPhone'];
            $localAddress = $_POST['newEmpLocalAddress'];
            $permanentAddress = $_POST['newEmpPermanentAddress'];
            $email = $_POST['newEmpEmail'];
            $password = $_POST['newEmpPassword'];
            $department = $_POST['newEmpDepartment'];
            $designation = $_POST['newEmpDesignation'];
            $joinDate = $_POST['newEmpJoinDate'];
            $salary = $_POST['newEmpSalary'];
            $accountHolderName = $_POST['newEmpAccountHolderName'];
            $accountNumber = $_POST['newEmpAccountNo'];
            $bankName = $_POST['newEmpBankName'];
            $ifscCode = $_POST['newEmpIfscCode'];
            $panNumber = $_POST['newEmpPanNo'];
            $branchName = $_POST['newEmpBranchName'];



            // MAKE DIRECTORY
            $targetDir = "views/img/employees/" . $code . "/";
            mkdir($targetDir, 0755);

            //  PROFILE IMAGE UPLOAD
            $imageName = $_FILES['newEmpImage']['tmp_name'];
            $imageType = $_FILES['newEmpImage']['type'];
            $image = "";
            if ($imageName) {
                list($width, $height) = getimagesize($imageName);
                $newWidth = 500;
                $newHeight = 500;

                // Create Jpg Image
                if ($imageType === 'image/jpeg') {
                    $image = $targetDir .  "profile.jpg";
                    $source = imagecreatefromjpeg($imageName);
                    $destination = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($destination, $image);
                }
                // Create Png Image
                if ($imageType === 'image/png') {
                    $image = $targetDir . "profile.png";
                    $source = imagecreatefrompng($imageName);
                    $destination = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($destination, $image);
                }
            }

            // RESUME UPLOAD
            $resumeName = $_FILES['newEmpResume']['name'];
            $resumeTmp = $_FILES['newEmpResume']['tmp_name'];
            $resume = "";
            if ($resumeName) {
                $ext = pathinfo($resumeName, PATHINFO_EXTENSION);
                $newName = "resume." . $ext;
                if (rename($resumeTmp, ($targetDir . $newName))) {
                    $resume = $targetDir . $newName;
                }
            }

            // OFFER LETTER UPLOAD
            $offerLetterName = $_FILES['newEmpOfferLetter']['name'];
            $offerLetterTmp = $_FILES['newEmpOfferLetter']['tmp_name'];
            $offerLetter = "";
            if ($offerLetterName) {
                $ext = pathinfo($offerLetterName, PATHINFO_EXTENSION);
                $newName = "offer-letter." . $ext;
                if (rename($offerLetterTmp, ($targetDir . $newName))) {
                    $offerLetter = $targetDir . $newName;
                }
            }

            // JOINING LETTER UPLOAD
            $joiningLetterName = $_FILES['newEmpJoiningLetter']['name'];
            $joiningLetterTmp = $_FILES['newEmpJoiningLetter']['tmp_name'];
            $joiningLetter = "";
            if ($joiningLetterName) {
                $ext = pathinfo($joiningLetterName, PATHINFO_EXTENSION);
                $newName = "joining-letter." . $ext;
                if (rename($joiningLetterTmp, ($targetDir . $newName))) {
                    $joiningLetter = $targetDir . $newName;
                }
            }

            // ID PROOF UPLOAD
            $idProofName = $_FILES['newEmpIdProof']['name'];
            $idProofTmp = $_FILES['newEmpIdProof']['tmp_name'];
            $idProof = "";
            if ($idProofName) {
                $ext = pathinfo($idProofName, PATHINFO_EXTENSION);
                $newName = "id-proof." . $ext;
                if (rename($idProofTmp, ($targetDir . $newName))) {
                    $idProof = $targetDir . $newName;
                }
            }

            // ENCRYPT PASSWORD
            $hash = password_hash($password, PASSWORD_BCRYPT);

            $table = "employees";
            $data = [
                ":code" => $code, ':name' => $name, ":father_name" => $fatherName, ":date_of_birth" => $dateOfBirth,
                ":gender" => $gender, ":phone" => $phone, ":local_address" => $localAddress, ":permanent_address" => $permanentAddress,
                ":image" => $image, ":email" => $email, ":password" => $hash, ":department_id" => $department,
                ":designation_id" => $designation, ":join_date" => $joinDate, ":salary" => $salary,
                ":account_holder_name" => $accountHolderName, ":account_number" => $accountNumber, ":bank_name" => $bankName,
                ":ifsc_code" => $ifscCode, ":pan" => $panNumber, ":branch" => $branchName, ":resume" => $resume,
                ":offer_letter" => $offerLetter, ":joining_letter" => $joiningLetter, ":id_proof" => $idProof, ":status" => 1
            ];
            $result = ModelEmployees::mdlCreateEmployee($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Employee $name has been Created',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'employees';
                        })
                </script>";
            }
        }
    }


    /*==============================================
        EDIT EMPLOYEE   
    ================================================== */
    static public function ctlrEditEmployee()
    {
        if (isset($_POST['editEmployee'])) {
            $code = $_POST['editEmpCode'];
            $name = $_POST['editEmpName'];
            $fatherName = $_POST['editEmpFatherName'];
            $dateOfBirth = $_POST['editEmpDoB'];
            $gender = $_POST['editEmpGender'];
            $phone = $_POST['editEmpPhone'];
            $localAddress = $_POST['editEmpLocalAddress'];
            $permanentAddress = $_POST['editEmpPermanentAddress'];
            $email = $_POST['editEmpEmail'];
            $password = $_POST['editEmpPassword'];
            $department = $_POST['editEmpDepartment'];
            $designation = $_POST['editEmpDesignation'];
            $joinDate = $_POST['editEmpJoinDate'];
            $salary = $_POST['editEmpSalary'];
            $accountHolderName = $_POST['editEmpAccountHolderName'];
            $accountNumber = $_POST['editEmpAccountNo'];
            $bankName = $_POST['editEmpBankName'];
            $ifscCode = $_POST['editEmpIfscCode'];
            $panNumber = $_POST['editEmpPanNo'];
            $branchName = $_POST['editEmpBranchName'];
            $exitDate = $_POST['editEmpExitDate'];
            $status = $_POST['editEmpStatus'];

            // CHECK FOLDER
            $targetDir = "views/img/employees/" . $code . "/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755);
            }

            // CHECK PROFILE IMAGE
            //  PROFILE IMAGE UPLOAD
            $imageName = $_FILES['editEmpImage']['tmp_name'];
            $imageType = $_FILES['editEmpImage']['type'];
            $imageActual = $_POST['editEmpImageActual'];

            $image = "";
            if ($imageName) {
                if ($imageActual) {
                    unlink($$imageActual);
                }
                list($width, $height) = getimagesize($imageName);
                $newWidth = 500;
                $newHeight = 500;

                // Create Jpg Image
                if ($imageType === 'image/jpeg') {
                    $image = $targetDir .  "profile.jpg";
                    $source = imagecreatefromjpeg($imageName);
                    $destination = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($destination, $image);
                }
                // Create Png Image
                if ($imageType === 'image/png') {
                    $image = $targetDir . "profile.png";
                    $source = imagecreatefrompng($imageName);
                    $destination = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($destination, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($destination, $image);
                }
            } else {
                $image = $imageActual;
            }

            // RESUME UPLOAD
            $resumeName = $_FILES['editEmpResume']['name'];
            $resumeTmp = $_FILES['editEmpResume']['tmp_name'];
            $resumeActual = $_POST['editEmpResumeActual'];
            $resume = "";
            if ($resumeName) {
                if ($resumeActual) {
                    unlink($resumeActual);
                }
                $ext = pathinfo($resumeName, PATHINFO_EXTENSION);
                $newName = "resume." . $ext;
                if (rename($resumeTmp, ($targetDir . $newName))) {
                    $resume = $targetDir . $newName;
                }
            } else {
                $resume = $resumeActual;
            }

            // OFFER LETTER UPLOAD
            $offerLetterName = $_FILES['editEmpOfferLetter']['name'];
            $offerLetterTmp = $_FILES['editEmpOfferLetter']['tmp_name'];
            $offerLetterActual = $_POST['editEmpOfferLetterActual'];
            $offerLetter = "";
            if ($offerLetterName) {
                if ($offerLetterActual) {
                    unlink($offerLetterActual);
                }
                $ext = pathinfo($offerLetterName, PATHINFO_EXTENSION);
                $newName = "offer-letter." . $ext;
                if (rename($offerLetterTmp, ($targetDir . $newName))) {
                    $offerLetter = $targetDir . $newName;
                }
            } else {
                $offerLetter = $offerLetterActual;
            }

            // JOINING LETTER UPLOAD
            $joiningLetterName = $_FILES['editEmpJoiningLetter']['name'];
            $joiningLetterTmp = $_FILES['editEmpJoiningLetter']['tmp_name'];
            $joiningLetterActual = $_POST['editEmpJoiningLetterActual'];
            $joiningLetter = "";
            if ($joiningLetterName) {
                if ($joiningLetterActual) {
                    unlink($joiningLetterActual);
                }
                $ext = pathinfo($joiningLetterName, PATHINFO_EXTENSION);
                $newName = "joining-letter." . $ext;
                if (rename($joiningLetterTmp, ($targetDir . $newName))) {
                    $joiningLetter = $targetDir . $newName;
                }
            } else {
                $joiningLetter = $joiningLetterActual;
            }

            // ID PROOF UPLOAD
            $idProofName = $_FILES['editEmpIdProof']['name'];
            $idProofTmp = $_FILES['editEmpIdProof']['tmp_name'];
            $idProofActual = $_POST['editEmpIdProofActual'];
            $idProof = "";
            if ($idProofName) {
                if ($idProofActual) {
                    unlink($idProofActual);
                }
                $ext = pathinfo($idProofName, PATHINFO_EXTENSION);
                $newName = "id-proof." . $ext;
                if (rename($idProofTmp, ($targetDir . $newName))) {
                    $idProof = $targetDir . $newName;
                }
            } else {
                $idProof = $idProofActual;
            }

            // PASSWORD
            if ($password) {
                $hash = password_hash($password, PASSWORD_BCRYPT);
            } else {
                $hash = $_POST['editEmpPasswordActual'];
            }
            // REQUEST
            $table = "employees";
            $data = [
                ':name' => $name, ":father_name" => $fatherName, ":date_of_birth" => $dateOfBirth,
                ":gender" => $gender, ":phone" => $phone, ":local_address" => $localAddress, ":permanent_address" => $permanentAddress,
                ":image" => $image, ":email" => $email, ":password" => $hash, ":department_id" => $department,
                ":designation_id" => $designation, ":join_date" => $joinDate, ":exit_date" => $exitDate, ":salary" => $salary,
                ":account_holder_name" => $accountHolderName, ":account_number" => $accountNumber, ":bank_name" => $bankName,
                ":ifsc_code" => $ifscCode, ":pan" => $panNumber, ":branch" => $branchName, ":resume" => $resume,
                ":offer_letter" => $offerLetter, ":joining_letter" => $joiningLetter, ":id_proof" => $idProof, ":status" => $status,
                ":code" => $code
            ];
            $result = ModelEmployees::mdlEditEmployee($table, $data);
            if ($result === "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Employee $name has been Updated',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'employees';
                        })
                </script>";
            }
        }
    }


    /*=====================================================
        DELETE EMPLOYEE
    ======================================================= */
    static public function cltrDeleteEmployee()
    {
        if (isset($_GET['employeeId'])) {

            $table = "employees";
            $item = "id";
            $value = $_GET['employeeId'];
            $employee = ModelEmployees::mdlShowEmployees($table, $item, $value);

            $image = $employee['image'];
            $resume = $employee['resume'];
            $offerLetter = $employee['offer_letter'];
            $joiningLetter = $employee['joining_letter'];
            $idProof = $employee['id_proof'];

            // REMOVE IMAGE
            if ($image) {
                unlink($image);
            }

            // REMOVE RESUME
            if ($resume) {
                unlink($resume);
            }

            // REMOVE OFFER LETTER  
            if ($offerLetter) {
                unlink($offerLetter);
            }

            // REMOVE JOINING LETTER
            if ($joiningLetter) {
                unlink($joiningLetter);
            }

            // REMOVE ID PROOF
            if ($idProof) {
                unlink($idProof);
            }

            $targetDir = "views/img/employees/" . $employee['code'] . "/";
            rmdir($targetDir);


            $result = ModelEmployees::mdlDeleteEmployee($table, $item, $value);
            if ($result == "ok") {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Employee has been Deleted',
                            confirmButtonText: 'Close'
                        }).then((res)=>{
                            window.location = 'employees';
                        })
                </script>";
            }
        }
    }
}
