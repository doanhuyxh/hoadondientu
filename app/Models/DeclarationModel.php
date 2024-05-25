<?php

class DeclarationModel extends Model
{

    function GetAllDeclaration($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc)
    {
        $conditions = [];
        $params = [];

        if (!empty($searchValue)) {
            $searchFields = ['full_name', 'personal_id', 'date_of_birth', 'address', 'phone_number', 'email', 'occupation', 'employer_name', 'employer_address', 'annual_income', 'tax_deductions', 'taxable_income', 'tax_rate', 'tax_amount', 'filing_date', 'created_at'];
            foreach ($searchFields as $field) {
                $conditions[] = "$field LIKE :searchValue";
            }
            $params[':searchValue'] = "%$searchValue%";
        }

        $searchCondition = !empty($conditions) ? 'WHERE ' . implode(' OR ', $conditions) : '';

        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT * FROM web_declaration $searchCondition $sortOrder LIMIT :limit OFFSET :offset");

        $stmt->bindParam(':limit', $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $start, PDO::PARAM_INT);

        foreach ($params as $param => $value) {
            $stmt->bindParam($param, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    function GetDeclarationById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM web_declaration WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    function createDeclaration($full_name, $personal_id, $date_of_birth, $address, $phone_number, $email, $occupation, $employer_name, $employer_address, $annual_income, $tax_deductions, $taxable_income, $tax_rate, $tax_amount, $filing_date)
    {
        $stmt = $this->connection->prepare('INSERT INTO web_declaration(full_name, personal_id, date_of_birth, address, phone_number, email, occupation, employer_name, employer_address, annual_income, tax_deductions, taxable_income, tax_rate, tax_amount, filing_date, created_at)
                VALUES(:full_name, :personal_id, :date_of_birth, :address, :phone_number, :email, :occupation, :employer_name, :employer_address, :annual_income, :tax_deductions, :taxable_income, :tax_rate, :tax_amount, :filing_date, NOW())');

        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':personal_id', $personal_id);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':employer_name', $employer_name);
        $stmt->bindParam(':employer_address', $employer_address);
        $stmt->bindParam(':annual_income', $annual_income);
        $stmt->bindParam(':tax_deductions', $tax_deductions);
        $stmt->bindParam(':taxable_income', $taxable_income);
        $stmt->bindParam(':tax_rate', $tax_rate);
        $stmt->bindParam(':tax_amount', $tax_amount);
        $stmt->bindParam(':filing_date', $filing_date);
        $stmt->execute();
    }

    function updateDeclaration($id, $full_name, $personal_id, $date_of_birth, $address, $phone_number, $email, $occupation, $employer_name, $employer_address, $annual_income, $tax_deductions, $taxable_income, $tax_rate, $tax_amount, $filing_date)
    {
        $stmt = $this->connection->prepare('UPDATE web_declaration SET full_name = :full_name, personal_id = :personal_id, date_of_birth = :date_of_birth, address = :address, phone_number = :phone_number, email = :email, occupation = :occupation, employer_name = :employer_name, employer_address = :employer_address, annual_income = :annual_income, tax_deductions = :tax_deductions, taxable_income = :taxable_income, tax_rate = :tax_rate, tax_amount = :tax_amount, filing_date = :filing_date WHERE id = :id');

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':personal_id', $personal_id);
        $stmt->bindParam(':date_of_birth', $date_of_birth);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':employer_name', $employer_name);
        $stmt->bindParam(':employer_address', $employer_address);
        $stmt->bindParam(':annual_income', $annual_income);
        $stmt->bindParam(':tax_deductions', $tax_deductions);
        $stmt->bindParam(':taxable_income', $taxable_income);
        $stmt->bindParam(':tax_rate', $tax_rate);
        $stmt->bindParam(':tax_amount', $tax_amount);
        $stmt->bindParam(':filing_date', $filing_date);
        $stmt->execute();
    }

    function DeleteDeclaration($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_declaration WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}