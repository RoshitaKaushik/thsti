using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class AddAdminModules : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "AdminModule",
                columns: table => new
                {
                    id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    name = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    path = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    iconName = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    order = table.Column<int>(type: "int", nullable: false, defaultValue: 0),
                    parentId = table.Column<int>(type: "int", nullable: true),
                    allowedRoles = table.Column<string>(type: "nvarchar(max)", nullable: false, defaultValue: "ADMIN"),
                    isActive = table.Column<bool>(type: "bit", nullable: false, defaultValue: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_AdminModule", x => x.id);
                    table.ForeignKey(
                        name: "FK_AdminModule_AdminModule_parentId",
                        column: x => x.parentId,
                        principalTable: "AdminModule",
                        principalColumn: "id");
                });

            migrationBuilder.CreateIndex(
                name: "IX_AdminModule_parentId",
                table: "AdminModule",
                column: "parentId");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "AdminModule");
        }
    }
}
