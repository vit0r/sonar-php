/*
 * SonarQube PHP Plugin
 * Copyright (C) 2010 SonarSource and Akram Ben Aissi
 * sonarqube@googlegroups.com
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02
 */
package org.sonar.plugins.php.api.tree.declaration;

import com.google.common.annotations.Beta;
import org.sonar.plugins.php.api.tree.expression.IdentifierTree;
import org.sonar.plugins.php.api.tree.lexical.SyntaxToken;
import org.sonar.plugins.php.api.tree.statement.BlockTree;
import org.sonar.plugins.php.api.tree.statement.StatementTree;

import javax.annotation.Nullable;

/**
 * <p><a href="http://php.net/manual/en/functions.user-defined.php">Function Declaration</a>
 * <pre>
 *  function {@link #name()} {@link #parameters()} {@link #body()}
 *  function & {@link #name()} {@link #parameters()} {@link #body()}
 * </pre>
 */
@Beta
public interface FunctionDeclarationTree extends FunctionTree, StatementTree, DeclarationTree {

  @Override
  SyntaxToken functionToken();

  @Nullable
  @Override
  SyntaxToken referenceToken();

  IdentifierTree name();

  @Override
  ParameterListTree parameters();

  @Override
  BlockTree body();

}